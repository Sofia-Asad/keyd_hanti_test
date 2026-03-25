<?php include 'db_connect.php'; include 'header.php'; ?>
<?php
session_start();
// Haddii uusan qofku soo gelin ama uusan ahayn Admin/Seller, dib u celi
if(!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'seller')){
    header("Location: login.php");
    exit();
}
include 'db_connect.php';
include 'header.php';
?>
<div style="max-width: 600px; margin: 30px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
    <h2 style="text-align: center;">Geli Hanti Cusub (Real Entry)</h2>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Magaca Hantida" style="width:100%; padding:10px; margin:10px 0;" required>
        
        <select name="category" style="width:100%; padding:10px; margin:10px 0;">
            <option value="House">Guri (House)</option>
            <option value="Land">Dhul (Land)</option>
            <option value="Plan">Naqshad (House Design/Plan)</option>
        </select>

        <input type="number" name="price" placeholder="Qiimaha ($)" style="width:100%; padding:10px; margin:10px 0;" required>
        <textarea name="description" placeholder="Faahfaahinta..." style="width:100%; padding:10px; margin:10px 0; height:80px;"></textarea>
        
        <label>Sawirka Guriga (Thumbnail):</label>
        <input type="file" name="image" style="margin:10px 0;" required>
        
        <label>Faylka Naqshadda (Optional - PDF/Image):</label>
        <input type="file" name="plan_file" style="margin:10px 0;">
        
        <button type="submit" name="upload" style="width:100%; padding:12px; background:#27ae60; color:white; border:none; cursor:pointer;">KAYDI HANTIDA</button>
    </form>

    <?php
    if(isset($_POST['upload'])) {
        $title = $_POST['title'];
        $cat = $_POST['category'];
        $price = $_POST['price'];
        $desc = $_POST['description'];

        // Uploading Image
        $imgName = $_FILES['image']['name'];
        $imgTemp = $_FILES['image']['tmp_name'];
        move_uploaded_file($imgTemp, "uploads/".$imgName);

        // Uploading Plan File (hadii uu jiro)
        $planName = $_FILES['plan_file']['name'];
        $planTemp = $_FILES['plan_file']['tmp_name'];
        if(!empty($planName)) {
            move_uploaded_file($planTemp, "uploads/".$planName);
        }

        $sql = "INSERT INTO properties (title, category, price, description, image_path, plan_file) 
                VALUES ('$title', '$cat', '$price', '$desc', 'uploads/$imgName', 'uploads/$planName')";
        
        if($conn->query($sql)) { echo "<p style='color:green;'>Waa la kaydiyay!</p>"; }
    }
    ?>
</div>
<?php include 'footer.php'; ?>