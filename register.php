<?php include 'db_connect.php'; include 'header.php'; ?>
<div style="max-width: 400px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
    <h2 style="text-align: center;">Abuur Account Cusub</h2>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" style="width:100%; padding:10px; margin:10px 0;" required>
        <input type="email" name="email" placeholder="Email" style="width:100%; padding:10px; margin:10px 0;" required>
        <input type="password" name="password" placeholder="Password" style="width:100%; padding:10px; margin:10px 0;" required>
        <select name="role" style="width:100%; padding:10px; margin:10px 0;">
            <option value="buyer">I am a Buyer</option>
            <option value="seller">I am a Seller</option>
        </select>
        <button type="submit" name="register" style="width:100%; padding:12px; background:#3498db; color:white; border:none; cursor:pointer;">REGISTER</button>
    </form>
    <?php
    if(isset($_POST['register'])){
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Amniga Password-ka
        $role = $_POST['role'];

        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$user', '$email', '$pass', '$role')";
        if($conn->query($sql)){ echo "<p style='color:green;'>Account-ka waa la sameeyay! Hadda Login dheh.</p>"; }
    }
    ?>
</div>