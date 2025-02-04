<?php
session_start();
include('db_connect.php'); // Includes your PDO connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Updated SQL query to fetch user data
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE admin_name = :username");
    $stmt->execute([':username' => $username]);

    $user = $stmt->fetch();

    // Check if the user exists and if the password matches
    if ($user) {
        if ($user['admin_password'] == $password) {  // Plain text password comparison
            $_SESSION['admin'] = $user['admin_name'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #4a90e2, #7b4397);
            font-family: Arial, sans-serif;
        }
        .login-container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            margin: 0 0 1rem;
            font-size: 24px;
            color: #333;
        }
        .login-container form input[type="text"],
        .login-container form input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin: 0.5rem 0;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        .login-container form button {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            background: #4a90e2;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .login-container form button:hover {
            background: #357ABD;
        }
        .error {
            color: red;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error_message)): ?>
        <script>
            alert("<?php echo $error_message; ?>");
        </script>
    <?php endif; ?>
    </div>
</body>
</html>
