<?php 
include 'db_connect.php'; 
include 'header.php'; 
?>

<style>
    .hero-section {
        background: linear-gradient(rgba(44, 62, 80, 0.7), rgba(44, 62, 80, 0.7)), url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1350&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 60px 20px;
        text-align: center;
    }

    .hero-section h1 { font-size: 2.2rem; margin-bottom: 10px; }
    .hero-section p { font-size: 1rem; opacity: 0.9; }

    .filter-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: -25px auto 40px auto;
        flex-wrap: wrap;
        position: relative;
        z-index: 10;
        padding: 0 10px;
    }

    .filter-btn {
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        background: white;
        color: #2c3e50;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        font-size: 14px;
        transition: 0.3s;
    }

    .filter-btn:hover, .filter-btn.active {
        background: #3498db !important;
        color: white !important;
        transform: translateY(-3px);
    }

    .property-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        padding: 0 5% 60px 5%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .property-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
        transition: 0.3s;
    }

    .property-card:hover { transform: translateY(-5px); }
    .property-thumb { width: 100%; height: 220px; object-fit: cover; }
    .property-content { padding: 20px; }
    .property-price { color: #27ae60; font-size: 1.4rem; font-weight: 800; margin: 10px 0; }
    .view-btn { display: block; background: #2c3e50; color: white; text-align: center; padding: 12px; text-decoration: none; border-radius: 10px; font-weight: 600; }

    /* Mobile View Optimization */
    @media (max-width: 480px) {
        .property-grid { grid-template-columns: 1fr; padding: 0 20px 40px 20px; }
        .hero-section h1 { font-size: 1.7rem; }
        .filter-btn { padding: 8px 15px; font-size: 12px; }
    }
</style>

<div class="hero-section">
    <h1>Raadi Gurigaaga Riyada</h1>
    <p>Waxaan kuu haynaa guryo iyo dhul tayo leh.</p>
</div>

<div class="filter-container">
    <a href="index.php" class="filter-btn <?php echo !isset($_GET['cat']) ? 'active' : ''; ?>">Dhammaan</a>
    <a href="index.php?cat=House" class="filter-btn <?php echo (isset($_GET['cat']) && $_GET['cat'] == 'House') ? 'active' : ''; ?>">Guryaha</a>
    <a href="index.php?cat=Land" class="filter-btn <?php echo (isset($_GET['cat']) && $_GET['cat'] == 'Land') ? 'active' : ''; ?>">Dhulka</a>
    <a href="index.php?cat=Plan" class="filter-btn <?php echo (isset($_GET['cat']) && $_GET['cat'] == 'Plan') ? 'active' : ''; ?>">Naqshadaha</a>
</div>

<div class="property-grid">
    <?php
    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    $cat = isset($_GET['cat']) ? mysqli_real_escape_string($conn, $_GET['cat']) : '';

    $sql = "SELECT * FROM properties WHERE status = 'approved'";
    if ($search != '') { $sql .= " AND (title LIKE '%$search%' OR description LIKE '%$search%')"; }
    if ($cat != '') { $sql .= " AND category = '$cat'"; }
    $sql .= " ORDER BY id DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $image = !empty($row['image_path']) ? $row['image_path'] : 'https://via.placeholder.com/400x300';
            echo '<div class="property-card">
                    <img src="'.$image.'" class="property-thumb">
                    <div class="property-content">
                        <span style="font-size:10px; color:#3498db; font-weight:700;">'.$row['category'].'</span>
                        <h3 style="font-size:1.1rem; margin:5px 0;">'.$row['title'].'</h3>
                        <p class="property-price">$'.number_format($row['price']).'</p>
                        <a href="details.php?id='.$row['id'].'" class="view-btn">Arag Faahfaahinta</a>
                    </div>
                  </div>';
        }
    } else {
        echo "<div style='grid-column: 1/-1; text-align: center; padding: 50px;'><h3>Ma jiraan wax la helay.</h3></div>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>