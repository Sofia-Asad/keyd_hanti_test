<?php 
session_start();
include 'db_connect.php'; 
include 'header.php'; 

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            
            header("Location: index.php"); 
        } else { echo "<p style='color:red;'>Password-ka waa qalad!</p>"; }
    } else { echo "<p style='color:red;'>Email-kan ma diiwaangashna!</p>"; }
}
?>

<div style="max-width: 400px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
    <h2 style="text-align: center;">Soo Gali (Login)</h2>
    <form action="" method="POST">
        <input type="email" name="email" placeholder="Email-kaaga" style="width:100%; padding:10px; margin:10px 0;" required>
        <input type="password" name="password" placeholder="Password-kaaga" style="width:100%; padding:10px; margin:10px 0;" required>
        <button type="submit" name="login" style="width:100%; padding:12px; background:#2c3e50; color:white; border:none; cursor:pointer; border-radius:5px;">LOGIN</button>
    </form>
    <p style="text-align:center;">Ma laha account? <a href="register.php">Is-diiwaangeli halkan</a></p>
</div>