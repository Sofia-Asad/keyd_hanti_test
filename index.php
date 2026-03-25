<?php include 'db_connect.php'; ?>
<?php include 'header.php'; ?>

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
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 600;
    }

    /* Qaybta Filter-ka (Badhamada) */
    .filter-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .filter-btn {
        text-decoration: none;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 500;
        background: white;
        color: #2c3e50;
        border: 1px solid #ddd;
        transition: 0.3s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .filter-btn:hover, .filter-btn.active {
        background: #3498db;
        color: white;
        border-color: #3498db;
        transform: translateY(-3px);
    }

    /* Property Grid (Guryaha Meesha ay ku jiraan) */
    .property-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        padding: 0 5%;
        max-width: 1300px;
        margin: 0 auto 50px auto;
    }

    /* Property Card Style */
    .property-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transition: 0.4s;
        border: 1px solid #eee;
    }

    .property-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .property-thumb {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .property-content {
        padding: 20px;
    }

    .property-cat {
        background: #f1f8ff;
        color: #3498db;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .property-title {
        font-size: 1.3rem;
        margin: 15px 0 10px 0;
        color: #2c3e50;
    }

    .property-price {
        color: #27ae60;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .view-btn {
        display: block;
        background: #2c3e50;
        color: white;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: 0.3s;
    }

    .view-btn:hover {
        background: #34495e;
    }
</style>

<div class="hero-section">
    <h1>Raadi Gurigaaga Riyada</h1>
    <p>Waxaan kuu haynaa guryo, dhul iyo naqshado tayo leh.</p>
</div>

<div class="filter-container">
    <a href="index.php" class="filter-btn <?php echo !isset($_GET['cat']) ? 'active' : ''; ?>">Dhammaan</a>
    <a href="index.php?cat=House" class="filter-btn <?php echo (isset($_GET['cat']) && $_GET['cat'] == 'House') ? 'active' : ''; ?>">Guryaha</a>
    <a href="index.php?cat=Land" class="filter-btn <?php echo (isset($_GET['cat']) && $_GET['cat'] == 'Land') ? 'active' : ''; ?>">Dhulka</a>
    <a href="index.php?cat=Plan" class="filter-btn <?php echo (isset($_GET['cat']) && $_GET['cat'] == 'Plan') ? 'active' : ''; ?>">Naqshadaha</a>
</div>

<div class="property-grid">
    <?php
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $cat = isset($_GET['cat']) ? $_GET['cat'] : '';

    $sql = "SELECT * FROM properties WHERE (title LIKE '%$search%' OR description LIKE '%$search%')";
    if ($cat != '') {
        $sql .= " AND category = '$cat'";
    }
    $sql .= " ORDER BY id DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Sawirka haddii uusan jirin, ku dar mid default ah
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
        echo "<h3 style='grid-column: 1/-1; text-align: center; color: #7f8c8d;'>Waan ka xunnahay, wax xog ah lama helin.</h3>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>