<?php
$conn = new mysqli("localhost", "root", "", "keyd_henti_test_db");

if ($conn->connect_error) {
    die("No Database Found: " . $conn->connect_error);
}
?>