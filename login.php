<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <main id="login-page">
        <div id="login-form-container">
            <div id="login-form-box">
                <h1>LogIn</h1>
                <form id="login-form" method="post">
                    <div>
                        <label for="name">Username:</label></br>
                        <input type="text" id="name" name="name" placeholder="Type a username" required>
                    </div>
                    <div>
                        <label for="password">Password:</label></br>
                        <input type="password" id="password" name="password" placeholder="Type a password" required>
                    </div>
                    <button>LogIn</button>
                </form>
                <p>Don't have an account? <a href="signup.html">Sign Up</a></p>
            </div>
        </div>
    </main>
</body>
</html>