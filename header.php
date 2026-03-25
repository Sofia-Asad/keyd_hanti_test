<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keyd-Hanti | Real Estate</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        header { background-color: #2c3e50; padding: 15px 5%; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; }
        .logo a { color: white; text-decoration: none; font-size: 24px; font-weight: 700; }
        
        .nav-links { list-style: none; display: flex; align-items: center; gap: 20px; }
        .nav-links li a { color: #ecf0f1; text-decoration: none; font-size: 14px; font-weight: 500; transition: 0.3s; }
        .nav-links li a:hover { color: #3498db; }

        .header-search { display: flex; background: rgba(255,255,255,0.1); border-radius: 20px; padding: 5px 15px; flex: 1; max-width: 250px; margin: 0 15px; }
        .header-search input { background: none; border: none; color: white; outline: none; width: 100%; font-size: 13px; }
        
        .btn-signup { background: #3498db; padding: 8px 18px; border-radius: 5px; color: white !important; }
        .btn-logout { color: #e74c3c !important; border: 1px solid #e74c3c; padding: 5px 12px; border-radius: 5px; }

        /* Mobile View */
        @media (max-width: 900px) {
            .nav-container { flex-direction: column; gap: 15px; }
            .header-search { max-width: 100%; width: 100%; order: 3; }
            .nav-links { flex-wrap: wrap; justify-content: center; gap: 12px; font-size: 12px; }
        }
    </style>
</head>
<body>
<header>
    <div class="nav-container">
        <div class="logo"><a href="index.php">Keyd-Hanti</a></div>
        
        <form action="index.php" method="GET" class="header-search">
            <input type="text" name="search" placeholder="Raadi hanti...">
        </form>

        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="add_property.php">Add Property</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <li><a href="admin_dashboard.php" style="color:#f1c40f;">Dashboard</a></li>
                <?php endif; ?>
                <li><a href="logout.php" class="btn-logout">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php" class="btn-signup">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>