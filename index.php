<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login and Register</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 20px;
         background-color: #f7f7f7;
      }

      h1 {
         margin-top: 0;
      }

      form {
         max-width: 400px;
         margin: 20px auto;
         padding: 20px;
         background-color: #fff;
         border-radius: 5px;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      form label {
         display: block;
         margin-bottom: 8px;
      }

      form input[type="text"],
      form input[type="email"],
      form input[type="password"] {
         width: 100%;
         padding: 10px;
         margin-bottom: 20px;
         border: 1px solid #ccc;
         border-radius: 5px;
         font-size: 16px;
      }

      form button {
         padding: 10px 20px;
         background-color: green;
         color: #fff;
         border: none;
         border-radius: 5px;
         font-size: 16px;
         cursor: pointer;
      }

      form button:hover {
         background-color: #0056b3;
      }
   </style>
</head>
<body>

<?php
// Function to handle user registration
function registerUser($conn, $name, $email, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $hashedPassword]);
}

// Function to handle user login
function loginUser($conn, $email, $password) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, log in the user
        return true;
    } else {
        // Invalid email or password
        return false;
    }
}

// Database connection
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "my_login_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Login form submitted
        $login_email = $_POST['login_email'];
        $login_password = $_POST['login_password'];

        if (loginUser($conn, $login_email, $login_password)) {
            echo "Login successful! Welcome, $login_email!";
        } else {
            echo "Invalid email or password.";
        }
    } elseif (isset($_POST['register'])) {
        // Registration form submitted
        $name = $_POST['name'];
        $email = $_POST['register_email'];
        $password = $_POST['register_password'];
        $confirm_email = $_POST['confirm_email'];

        // Check if the email already exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo "Email already exists. Please use a different email.";
        } elseif ($email !== $confirm_email) {
            echo "Email and Confirm Email do not match.";
        } else {
            registerUser($conn, $name, $email, $password);
            echo "Registration successful! You can now log in with your credentials.";
        }
    }
}
?>

<h1 style="text-align:center">Register</h1>
<form action="" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <label for="register_email">Email:</label>
    <input type="email" name="register_email" required>
    <label for="confirm_email">Confirm Email:</label>
    <input type="email" name="confirm_email" required>
    <label for="register_password">Password:</label>
    <input type="password" name="register_password" required>
    <button type="submit" name="register">Register</button>
</form>

</body>
</html>
