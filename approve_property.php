<?php
session_start();
include 'db_connect.php';

if ($_SESSION['role'] == 'admin' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("UPDATE properties SET status = 'approved' WHERE id = $id");
    header("Location: admin_dashboard.php");
}
?>