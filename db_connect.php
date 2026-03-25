<?php
$host = "sql211.infinityfree.com";
$user = "if0_41477134";
$pass = "sofiaAsad"; 
$dbname = "if0_41477134_keyd_henti";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Xiriirka database-ka waa uu fashilmay: " . $conn->connect_error);
}