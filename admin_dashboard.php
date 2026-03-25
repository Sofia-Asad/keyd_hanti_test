<?php
session_start();
include 'db_connect.php';

// Hubi in qofka soo galay uu yahay Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include 'header.php';

// Tirakoobka guud (Stats)
$total_properties = $conn->query("SELECT COUNT(*) as total FROM properties")->fetch_assoc()['total'];
$total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$total_orders = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];
?>

<style>
    .admin-container { padding: 40px 5%; background: #f4f7f6; min-height: 100vh; }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
    .stat-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; border-top: 4px solid #3498db; }
    .stat-card h3 { font-size: 2rem; color: #2c3e50; }
    .admin-table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    .admin-table th, .admin-table td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
    .admin-table th { background: #2c3e50; color: white; }
    .delete-btn { color: #e74c3c; text-decoration: none; font-weight: bold; }
    .delete-btn:hover { text-decoration: underline; }
</style>

<div class="admin-container">
    <h1 style="margin-bottom: 20px;">Admin Dashboard</h1>

    <div class="stats-grid">
        <div class="stat-card">
            <p>Dhammaan Hantida</p>
            <h3><?php echo $total_properties; ?></h3>
        </div>
        <div class="stat-card">
            <p>Isticmaaleyaasha</p>
            <h3><?php echo $total_users; ?></h3>
        </div>
        <div class="stat-card">
            <p>Dalabaadka (Orders)</p>
            <h3><?php echo $total_orders; ?></h3>
        </div>
    </div>

    <h2>Maamul Hantida (Manage Properties)</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sawirka</th>
                <th>Magaca</th>
                <th>Nooca</th>
                <th>Qiimaha</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = $conn->query("SELECT * FROM properties ORDER BY id DESC");
            while($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td><img src='".$row['image_path']."' width='50' style='border-radius:5px;'></td>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['category']."</td>";
                echo "<td>$".number_format($row['price'])."</td>";
                echo "<td><a href='delete_property.php?id=".$row['id']."' class='delete-btn' onclick='return confirm(\"Ma hubtaa inaad tirtirto?\")'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>