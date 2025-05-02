<?php

// Please create a database before testing the code.
// Then create the table below.
// Github don't do databases.

// CREATE TABLE users (
//     id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(50) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     email VARCHAR(100) NOT NULL UNIQUE,
//     registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );

// Database credentials
$servername = "localhost"; // Replace with your server name
$dbname = "docflow_db";    // Replace with your database name
$dbusername = "root"; // Replace with your database username
$dbpassword = ""; // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);
    $email = trim($_POST["email"]);

    // Basic input validation
    if (empty($username) || empty($password) || empty($confirm_password) || empty($email)) {
        echo "Please fill in all fields.";
    } elseif ($password != $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Check if username or email already exists
        $sql = "SELECT id FROM users WHERE username = :username OR email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Username or email already exists.";
        } else {
            // Hash the password securely
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and execute the SQL query to insert user data
            $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Registration successful! You can now <a href='login.html'>login</a>.";
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
    }

    // Close the database connection
    unset($pdo);
}
?>