<?php 
include 'db_connect.php'; 
include 'header.php'; 
?>
<style>
    .hero-section { background: linear-gradient(rgba(44,62,80,0.7), rgba(44,62,80,0.7)), url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1350&q=80'); background-size: cover; background-position: center; color: white; padding: 80px 20px; text-align: center; }
    .hero-section h1 { font-size: 2.5rem; font-weight: 700; margin-bottom: 10px; }
    
    .filter-container { display: flex; justify-content: center; gap: 15px; margin: -30px auto 40px auto; flex-wrap: wrap; position: relative; z-index: 10; padding: 0 10px; }
    .filter-btn { text-decoration: none; padding: 12px 28px; border-radius: 50px; background: white; color: #2c3e50; box-shadow: 0 4px 15px rgba(0,0,0,0.1); font-weight: 600; transition: 0.3s; }
    .filter-btn.active, .filter-btn:hover { background: #3498db !important; color: white !important; transform: translateY(-5px); }

    .property-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; padding: 0 5% 60px 5%; max-width: 1300px; margin: 0 auto; }
    .property-card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid #f0f0f0; transition: 0.4s; }
    .property-thumb { width: 100%; height: 230px; object-fit: cover; }
    .property-content { padding: 25px; }
    .property-price { color: #27ae60; font-size: 1.5rem; font-weight: 800; margin-top: 10px; }
    .view-btn { display: block; background: #2c3e50; color: white; text-align: center; padding: 12px; text-decoration: none; border-radius: 10px; font-weight: 600; margin-top: 15px; }

    @media (max-width: 480px) { .property-grid { grid-template-columns: 1fr; } .hero-section h1 { font-size: 1.8rem; } }
</style>

<div class="hero-section">
    <h1>Raadi Gurigaaga Riyada</h1>
    <p>Waxaan kuu haynaa guryo, dhul iyo naqshado tayo leh oo la xaqiijiyay.</p>
</div>

<div class="filter-container">
    <a href="index.php" class="filter-btn <?php echo !isset($_GET['cat']) ? 'active' : ''; ?>">Dhammaan</a>
    <a href="index.php?cat=House" class="filter-btn <?php echo (isset($_GET['cat']) && $_GET['cat'] == 'House') ? 'active' : ''; ?>">Guryaha</a>
    <a href="index.php?cat=Land" class="filter-btn <?php echo (isset($_GET['cat']) && $_GET['cat'] == 'Land') ? 'active' : ''; ?>">Dhulka</a>
    <a href="index.php?cat=Plan" class="filter-btn <?php echo (isset($_GET['cat']) && $_GET['cat'] == 'Plan') ? 'active' : ''; ?>">Naqshadaha</a>
</div>

<div class="property-grid">
    <?php
    $cat = isset($_GET['cat']) ? mysqli_real_escape_string($conn, $_GET['cat']) : '';
    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    
    $sql = "SELECT * FROM properties WHERE status = 'approved'";
    if ($cat != '') { $sql .= " AND category = '$cat'"; }
    if ($search != '') { $sql .= " AND (title LIKE '%$search%' OR description LIKE '%$search%')"; }
    $sql .= " ORDER BY id DESC";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $img = !empty($row['image_path']) ? $row['image_path'] : 'https://via.placeholder.com/400x300';
            echo '<div class="property-card">
                    <img src="'.$img.'" class="property-thumb">
                    <div class="property-content">
                        <span style="color:#3498db; font-size:11px; font-weight:700; text-transform:uppercase;">'.$row['category'].'</span>
                        <h3 style="margin:8px 0; font-size:1.2rem;">'.$row['title'].'</h3>
                        <p class="property-price">$'.number_format($row['price']).'</p>
                        <a href="details.php?id='.$row['id'].'" class="view-btn">Arag Faahfaahinta</a>
                    </div>
                  </div>';
        }
    } else {
        echo "<div style='grid-column:1/-1; text-align:center; padding:50px;'><h3>Ma jiraan wax la helay.</h3></div>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>