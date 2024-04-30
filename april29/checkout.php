<?php
session_start();
include("db_connection.php");

// Retrieve item names and prices from URL parameters
$itemNames = isset($_GET['itemNames']) ? explode(',', $_GET['itemNames']) : [];
$itemPrices = isset($_GET['itemPrices']) ? explode(',', $_GET['itemPrices']) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Hive - Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-image: url('img/bee_hive_pattern.png');
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 70px;
            text-align: center;
            position: relative;
        }
        header h1 {
            font-size: 48px;
            color: #000;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .navbar {
            background-color: #000;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
        footer {
            background-color: #000;
            color: #999;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<header>
    <h1>Art Hive</h1>
</header>
<div class="navbar">
    <a href="Homepage.php">Home</a>
    <a href="Marketplace.php">Marketplace</a>
    <a href="sell.php">Sell</a>
    <a href="posts.php">Posts</a>
    <a href="account.php">Account</a>
</div>

<div class="container">
    <h2>Checkout</h2>
    <?php if (!empty($itemNames)): ?>
        <ul>
            <?php for ($i = 0; $i < count($itemNames); $i++): ?>
                <li><?php echo $itemNames[$i] . ' - $' . $itemPrices[$i]; ?></li>
            <?php endfor; ?>
        </ul>
        <button onclick="checkout()">Checkout</button>
    <?php else: ?>
        <p>No items in the cart.</p>
    <?php endif; ?>
</div>
<script>
    function checkout() {
        alert("Thank you for your purchase!");
        window.location.href = 'Homepage.php';
    }
</script>
</body>
</html>