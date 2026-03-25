<?php include 'db_connect.php'; include 'header.php'; ?>

<div style="max-width: 800px; margin: 40px auto; background: white; padding: 25px; border-radius: 10px;">
    <?php
    $id = $_GET['id'];
    $res = $conn->query("SELECT * FROM properties WHERE id=$id");
    $row = $res->fetch_assoc();

    if($row) {
        echo "<h1>".$row['title']." <span style='font-size:15px; background:#eee; padding:5px;'>".$row['category']."</span></h1>";
        echo "<img src='".$row['image_path']."' style='width:100%; border-radius:10px;'>";
        echo "<h3>Qiimaha: $".number_format($row['price'])."</h3>";
        echo "<p>".$row['description']."</p>";

        
        if(!empty($row['plan_file'])) {
            echo "<a href='".$row['plan_file']."' download style='background:#e67e22; color:white; padding:15px; text-decoration:none; display:inline-block; border-radius:5px;'>DOWNLOAD HOUSE PLAN (PDF)</a>";
        }
    }
    ?>

</div>
<?php include 'footer.php'; ?>