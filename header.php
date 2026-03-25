<!DOCTYPE html>
<html lang="so">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keyd-Hanti Marketplace</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
        }

        /* Navbar Style */
        .navbar {
            background: #2c3e50;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo h2 {
            color: #ffffff;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* Modern Search Bar Design */
        .search-form {
            display: flex;
            background: white;
            border-radius: 50px;
            padding: 3px;
            width: 40%;
            min-width: 300px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        }

        .search-input {
            border: none;
            padding: 10px 20px;
            border-radius: 50px 0 0 50px;
            outline: none;
            flex-grow: 1;
            font-size: 14px;
            color: #333;
        }

        .search-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: #2980b9;
            transform: scale(1.05);
        }

        /* Navigation Links */
        .nav-links {
            display: flex;
            gap: 25px;
        }

        .nav-links a {
            color: #ecf0f1;
            text-decoration: none;
            font-weight: 400;
            font-size: 15px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #3498db;
        }

        /* Active link highlight */
        .nav-links a.active {
            color: #3498db;
            border-bottom: 2px solid #3498db;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }
            .search-form {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="logo">
        <h2>Keyd-Hanti</h2>
    </div>

    <form action="index.php" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search for House or Location..." class="search-input">
        <button type="submit" class="search-btn">Search</button>
    </form>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="add_property.php">Add Property</a>
        <a href="contact.php">Contact Us</a>
    </div>
</div>