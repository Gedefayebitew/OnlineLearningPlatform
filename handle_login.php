<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = '';
    $dbname = "online_gede";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query the database to check if the user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // User exists and password is correct
            // Start the session and store user information (you can add more user data if needed)
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to the dashboard or homepage after successful login
            header('Location: http://localhost/gedetech/gg/lecture.html');
            exit();
        } else {
            // Invalid login credentials
            header('Location: http://localhost/gedetech/gg/php/login.php?error=InvalidCredentials');
            exit();
        }
    } catch (PDOException $e) {
        // Handle database connection errors or other exceptions
        echo "Error: " . $e->getMessage();
    }
}
?>
