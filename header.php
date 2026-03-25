<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
?>
<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keyd-Hanti | Real Estate Marketplace</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        header {
            background-color: #2c3e50;
            padding: 15px 5%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-links li a {
            color: #ecf0f1;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: 0.3s;
        }

        .nav-links li a:hover {
            color: #3498db;
        }

        /* Dashboard Link Special Style */
        .admin-link {
            background: #f1c40f;
            color: #2c3e50 !important;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: 700 !important;
        }

        .admin-link:hover {
            background: #f39c12 !important;
        }

        /* Logout Button */
        .logout-btn {
            color: #e74c3c !important;
            border: 1px solid #e74c3c;
            padding: 5px 12px;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background: #e74c3c;
            color: white !important;
        }

        .user-name {
            color: #bdc3c7;
            font-size: 13px;
            margin-right: 5px;
        }

        /* Search Bar in Header */
        .header-search {
            display: flex;
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 5px 15px;
        }

        .header-search input {
            background: none;
            border: none;
            color: white;
            padding: 5px;
            outline: none;
        }

        .header-search input::placeholder { color: #bdc3c7; }
    </style>
</head>
<body>

<header>
    <div class="nav-container">
        <div class="logo">
            <a href="index.php">Keyd-Hanti</a>
        </div>

        <form action="index.php" method="GET" class="header-search">
            <input type="text" name="search" placeholder="Raadi hanti...">
        </form>

        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="add_property.php">Add Property</a></li>
            <li><a href="contact.php">Contact Us</a></li>

            <?php if(isset($_SESSION['user_id'])): ?>
                
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <li><a href="admin_dashboard.php" class="admin-link">Dashboard</a></li>
                <?php endif; ?>

                <li>
                    <span class="user-name">Waa: <?php echo $_SESSION['username']; ?></span>
                    <a href="logout.php" class="logout-btn">Logout</a>
                </li>

            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php" style="background: #3498db; padding: 8px 15px; border-radius: 5px;">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>