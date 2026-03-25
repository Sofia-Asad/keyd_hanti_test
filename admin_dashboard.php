<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    
    header("Location: login.php");
    exit();
}

include 'header.php';


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
    
    .btn { padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 12px; font-weight: 600; transition: 0.3s; display: inline-block; }
    .btn-approve { background: #27ae60; color: white; margin-right: 5px; }
    .btn-approve:hover { background: #219150; }
    .btn-delete { background: #e74c3c; color: white; }
    .btn-delete:hover { background: #c0392b; }
</style>

<div class="admin-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1>Admin Dashboard</h1>
        <p>Ku soo dhawaaw, <strong><?php echo $_SESSION['username']; ?></strong></p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <p>Dhammaan Hantida</p>
            <h3><?php echo $total_properties; ?></h3>
        </div>
        <div class="stat-card">
            <p>Isticmaaleyaasha</p>
            <h3><?php echo $total_users; ?></h3>
        </div>
        <div class="stat-card" style="border-bottom-color: #f1c40f;">
            <p>Sugaya Approval</p>
            <h3><?php echo $pending_approvals; ?></h3>
        </div>
    </div>

    <div class="admin-table-container">
        <h2 style="margin-bottom: 20px;">Maamulka Hantida</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sawirka</th>
                    <th>Magaca</th>
                    <th>Nooca</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM properties ORDER BY id DESC");
                if($res && $res->num_rows > 0) {
                    while($row = $res->fetch_assoc()) {
                        $status_class = ($row['status'] == 'approved') ? 'status-approved' : 'status-pending';
                        echo "<tr>";
                        echo "<td>#".$row['id']."</td>";
                        
                        // Hubi sawirka
                        $img = !empty($row['image_path']) ? $row['image_path'] : 'https://via.placeholder.com/60';
                        echo "<td><img src='$img' width='60' height='45' style='object-fit:cover; border-radius:4px;'></td>";
                        
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".$row['category']."</td>";
                        echo "<td><span class='status-badge $status_class'>".ucfirst($row['status'])."</span></td>";
                        echo "<td>";
                        
                        
                        if ($row['status'] == 'pending') {
                            echo "<a href='approve_property.php?id=".$row['id']."' class='btn btn-approve'>Approve</a>";
                        }
                        
                        echo "<a href='delete_property.php?id=".$row['id']."' class='btn btn-delete' onclick='return confirm(\"Ma hubtaa inaad tirtirto?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; padding: 20px;'>Wax hanti ah laguma hayo database-ka.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>