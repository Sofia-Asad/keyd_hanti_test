<?php
session_start();
include 'db_connect.php';

// 1. Hubi in qofka soo galay uu yahay Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include 'header.php';

// 2. Tirakoobka guud (Stats)
$total_properties = $conn->query("SELECT COUNT(*) as total FROM properties")->fetch_assoc()['total'];
$total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$pending_approvals = $conn->query("SELECT COUNT(*) as total FROM properties WHERE status = 'pending'")->fetch_assoc()['total'];
?>

<style>
    .admin-container { padding: 40px 5%; background: #f4f7f6; min-height: 100vh; font-family: 'Poppins', sans-serif; }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
    .stat-card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); text-align: center; border-bottom: 4px solid #3498db; }
    .stat-card h3 { font-size: 2.2rem; color: #2c3e50; margin: 10px 0; }
    .stat-card p { color: #7f8c8d; font-weight: 500; }
    
    .admin-table-container { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow-x: auto; }
    .admin-table { width: 100%; border-collapse: collapse; }
    .admin-table th, .admin-table td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
    .admin-table th { background: #f8f9fa; color: #2c3e50; font-weight: 600; }
    
    .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-approved { background: #d4edda; color: #155724; }
    
    .btn { padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 13px; font-weight: 500; transition: 0.3s; }
    .btn-approve { background: #27ae60; color: white; margin-right: 5px; }
    .btn-approve:hover { background: #219150; }
    .btn-delete { background: #e74c3c; color: white; }
    .btn-delete:hover { background: #c0392b; }
</style>

<div class="admin-container">
    <div