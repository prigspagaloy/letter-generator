<?php

// Database connection details
$servername = "localhost"; // Replace with your database server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "docflow_db";    // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDir = 'uploads/'; // Specify the directory where you want to save the uploaded files
    // Ensure the upload directory exists
    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die("Failed to create upload directory."); // Stop if directory creation fails
        }
    }

    $uploadedFile = $_FILES['file'];
    $fileName = basename($uploadedFile['name']);
    $targetFilePath = $uploadDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check for upload errors
    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        // Validate file size (optional)
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if ($uploadedFile['size'] > $maxFileSize) {
            echo "Error: File size exceeds the maximum allowed limit.";
        } else {
            // Allow certain file formats (optional)
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx']; // Added 'doc' and 'docx'
            if (in_array(strtolower($fileType), $allowedTypes)) {
                // Move the uploaded file to the desired directory
                if (move_uploaded_file($uploadedFile['tmp_name'], $targetFilePath)) {
                    echo "File uploaded successfully! ";

                    // Prepare and execute the SQL query to store file information in the database
                    $sql = "INSERT INTO files (filename, filepath, upload_date) VALUES (?, ?, NOW())";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $fileName, $targetFilePath);

                    if ($stmt->execute()) {
                        echo "File information saved to the database.";
                    } else {
                        echo "Error saving file information to the database: " . $stmt->error;
                        // Optionally, you might want to delete the uploaded file if database storage fails
                        unlink($targetFilePath);
                    }

                    $stmt->close();
                } else {
                    echo "Error: Failed to move the uploaded file.";
                }
            } else {
                echo "Error: Invalid file format. Allowed formats: " . implode(', ', $allowedTypes);
            }
        }
    } else {
        // Handle different upload errors (as in the previous example)
        switch ($uploadedFile['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo "Error: The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "Error: The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "Error: The uploaded file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "Error: No file was uploaded.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "Error: Missing a temporary folder.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "Error: Failed to write file to disk.";
                break;
            case UPLOAD_ERR_EXTENSION:
                echo "Error: File upload stopped by extension.";
                break;
            default:
                echo "Error: An unknown error occurred during file upload.";
        }
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload and Save to Database</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        Select file to upload:
        <input type="file" name="file" id="file">
        <input type="submit" value="Upload File" name="submit">
    </form>
</body>
</html>
