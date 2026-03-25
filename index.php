<?php 
session_start();
include 'db_connect.php'; 
include 'header.php'; 
?>

<style>
    /* Qaybta Hero-ga (Korka) */
    .hero-section {
        background: linear-gradient(rgba(44, 62, 80, 0.7), rgba(44, 62, 80, 0.7)), url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 80px 20px;
        text-align: center;
        margin-bottom: 40px;
    }

    .hero-section h1 {
        font-size: 2.8rem;
        margin-bottom: 15px;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hero-section p {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    /* Qaybta Filter-ka (Badhamada) */
    .filter-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: -30px auto 40px auto; /* Wax yar kor ayay u kacaysaa */
        flex-wrap: wrap;
        position: relative;
        z-index: 10;
    }

    .filter-btn {
        text-decoration: none;
        padding: 14px 30px;
        border-radius: 50px;
        font-weight: 600;
        background: white;
        color: #2c3e50;
        border: none;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .filter-btn:hover, .filter-btn.active {
        background: #3498db;
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.3);
    }

    /* Property Grid */
    .property-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        padding: 0 5%;
        max-width: 1300px;
        margin: 0 auto 60px auto;
    }

    /* Property Card Style */
    .property-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        transition: 0.4s;
        border: 1px solid #f0f0f0;
    }

    .property-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }

    .property-thumb {
        width: 100%;
        height: 230px;
        object-fit: cover;
    }

    .property-content {
        padding: 25px;
    }

    .property-cat {
        background: #ebf5ff;
        color: #3498db;
        padding: 5px 15px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .property-title {
        font-size: 1.4rem;
        margin: 15px 0 10px 0;
        color: #2c3e50;
        font-weight: 600;
    }

    .property-price {
        color: #27ae60;
        font-size: 1.6rem;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .view-btn {
        display: block;
        background: #2c3e50;
        color: white;
        text-align: center;
        padding: 14px;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        transition: 0.3s;
    }

    .view-btn:hover {
        background: #34495e;
    }
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
    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    $cat = isset($_GET['cat']) ? mysqli_real_escape_string($conn, $_GET['cat']) : '';

    // SQL-ka oo hadda leh status = 'approved'
    $sql = "SELECT * FROM properties WHERE status = 'approved'";
    
    if ($search != '') {
        $sql .= " AND (title LIKE '%$search%' OR description LIKE '%$search%')";
    }
    
    if ($cat != '') {
        $sql .= " AND category = '$cat'";
    }
    
    $sql .= " ORDER BY id DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $image = !empty($row['image_path']) ? $row['image_path'] : 'https://via.placeholder.com/400x300?text=No+Image';
            
            echo '<div class="property-card">';
            echo '<img src="'.$image.'" class="property-thumb" alt="'.$row['title'].'">';
            echo '<div class="property-content">';
            echo '<span class="property-cat">'.$row['category'].'</span>';
            echo '<h3 class="property-title">'.$row['title'].'</h3>';
            echo '<p class="property-price">$'.number_format($row['price']).'</p>';
            echo '<a href="details.php?id='.$row['id'].'" class="view-btn">Arag Faahfaahinta</a>';
            echo '</div></div>';
        }
    } else {
        echo "<div style='grid-column: 1/-1; text-align: center; padding: 50px;'>
                <img src='https://cdn-icons-png.flaticon.com/512/6134/6134065.png' width='100' style='opacity:0.2;'>
                <h3 style='color: #7f8c8d; margin-top:20px;'>Waan ka xunnahay, hadda ma jiraan guryo la aqbalay oo qaybtan ku jira.</h3>
              </div>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>