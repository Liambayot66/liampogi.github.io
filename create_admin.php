<?php
include("firebaseRDB.php");

$db = new firebaseRDB("https://capstone101-db9a8-default-rtdb.asia-southeast1.firebasedatabase.app/");

$data = [
    'username' => 'Liam',
    'password' => password_hash('liam', PASSWORD_DEFAULT),
    'role' => 'admin'
];

$result = $db->insert("users", $data);
echo "Admin account created successfully!";
?>
