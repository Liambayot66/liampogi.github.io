<?php
session_start();
include("firebaseRDB.php");

$db = new firebaseRDB("https://capstone101-db9a8-default-rtdb.asia-southeast1.firebasedatabase.app/");

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = $db->retrieve("users");
    $found = false;

    foreach ($users as $id => $user) {
        if ($user['username'] === $_POST['username'] && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $found = true;

            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } elseif ($user['role'] == 'employee') {
                header("Location: employee_dashboard.php");
            } else {
                header("Location: residence_dashboard.php");
            }
            exit;
        }
    }

    if (!$found) $error = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | InstaStyle</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #121212;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .login-box {
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 16px;
            width: 300px;
            text-align: center;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.05);
        }

        .login-box h2 {
            margin-bottom: 20px;
            font-weight: 500;
            color: #fafafa;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background-color: #2b2b2b;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 14px;
        }

        .login-box input::placeholder {
            color: #aaa;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background-color: #0095f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-box button:hover {
            background-color: #007dd1;
        }

        .error {
            color: #ff5c5c;
            font-size: 14px;
            margin-top: 10px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log In</button>
        </form>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <div class="footer">© 2025 InstaStyle</div>
    </div>
</body>
</html>
