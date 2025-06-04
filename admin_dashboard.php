<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

include("firebaseRDB.php");
$db = new firebaseRDB("https://capstone101-db9a8-default-rtdb.asia-southeast1.firebasedatabase.app/");

$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'role' => $_POST['role']
    ];

    $db->insert("users", $data);
    $success = "✅ Account created successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <style>
        html, body {
            margin: 0; padding: 0; height: 100%;
            background-color: #121212;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center; /* vertical centering */
            min-height: 100vh;
        }

        .container {
            background-color: #1e1e1e;
            padding: 30px 40px;
            border-radius: 16px;
            width: 800px;
            box-shadow: 0 0 12px rgba(255, 255, 255, 0.04);
            text-align: center;
        }

        h2 {
            margin: 0 0 20px 0;
            font-weight: 500;
            color: #fafafa;
        }

        form {
            display: flex;
            gap: 15px;
            align-items: center;
            justify-content: center;
        }

        input[type="text"],
        input[type="password"],
        select {
            padding: 12px;
            background-color: #2b2b2b;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            box-sizing: border-box;
            outline: none;
        }

        input[type="text"] {
            width: 180px;
        }

        input[type="password"] {
            width: 180px;
        }

        select {
            width: 150px;
            appearance: none;
            cursor: pointer;
        }

        button {
            padding: 12px 25px;
            background-color: #0095f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            white-space: nowrap;
        }

        button:hover {
            background-color: #007dd1;
        }

        .success {
            margin-top: 20px;
            color: #32cd32;
            font-size: 14px;
        }

        .logout {
            display: inline-block;
            margin-top: 25px;
            font-size: 13px;
            color: #ccc;
            text-decoration: none;
        }

        .logout:hover {
            color: #ff4d4d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="New Username" required />
            <input type="password" name="password" placeholder="New Password" required />
            <select name="role" required>
                <option value="employee">Employee</option>
                <option value="residence">Residence</option>
            </select>
            <button type="submit">Add Account</button>
        </form>
        <?php if ($success): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>
        <a class="logout" href="logout.php">Log out</a>
    </div>
</body>
</html>
