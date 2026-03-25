<?php 
session_start();
include 'db_connect.php'; 
include 'header.php'; 

$prop_id = $_GET['id'];
$res = $conn->query("SELECT * FROM properties WHERE id=$prop_id");
$item = $res->fetch_assoc();
?>

<div style="max-width: 600px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; text-align: center;">
    <h2>Lacag Bixinta (Payment)</h2>
    <p>Waxaad iibsanaysaa: <strong><?php echo $item['title']; ?></strong></p>
    <p style="font-size: 24px; color: #27ae60; font-weight: bold;">Qiimaha: $<?php echo number_format($item['price']); ?></p>
    
    <div style="background: #f9f9f9; padding: 20px; border: 1px dashed #3498db; margin: 20px 0;">
        <h4>Ku soo dir lacagta:</h4>
        <p><strong>EVC Plus / Sahal:</strong> 061XXXXXXX</p>
        <p><strong>eDahab:</strong> 062XXXXXXX</p>
    </div>

    <form action="" method="POST">
        <input type="text" name="trans_id" placeholder="Geli Transaction ID-ga lacagta" style="width:100%; padding:12px; margin-bottom:10px;" required>
        <button type="submit" name="pay" style="width:100%; padding:12px; background:#27ae60; color:white; border:none; border-radius:5px; cursor:pointer;">XAQIIJI LACAGTA</button>
    </form>
</div>