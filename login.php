<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 90%;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #03917e;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .login-container input[type="text"]:focus,
        .login-container input[type="password"]:focus {
            border-color: #03917e;
        }

        .login-container .btn {
            background-color: #03917e;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .login-container .btn:hover {
            background-color: #037164;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <!-- Add your HTML and other code for login page here -->

<form action="http://localhost/gedetech/gg/php/handle_login.php" method="post">
    <!-- Your input fields for username and password -->
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <!-- Your login button -->
    
</form>

            <button class="btn" type="submit">Login</button>
        </form>
    </div>
</body>
</html>
