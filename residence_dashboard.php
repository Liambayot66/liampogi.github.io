<?php
session_start();
if ($_SESSION['role'] !== 'residence') {
    header("Location: index.php");
    exit;
}
?>
<h2>Welcome, Residence <?= $_SESSION['username'] ?>!</h2>
<p>You cannot add accounts.</p>
<a href="logout.php">Logout</a>
