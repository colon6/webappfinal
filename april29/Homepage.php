<!DOCTYPE html>
<?php
session_start();
include ("db_connection.php");

$uid = $_SESSION['uid'];    






?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Hive</title>
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
        section {
            padding: 20px;
            text-align: center;
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
        table {
            width: 100%;
        }
        table td {
            vertical-align: top;
            width: 20%; 
            padding: 5px;
        }
        table img {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <header>
    <h1>Art Hive</h1>
    <h1>Welcome <?php echo $uid ?> </h1>
    </header>
    <div class="navbar">
        <a href="Homepage.php">Home</a>
        <a href="Marketplace.php">Marketplace</a>
        <a href="sell.php">Sell</a>
    <a href="posts.php">Posts</a>
        <a href="account.php">Account</a>
    </div>
    <section>
        <h2>Featured Artwork</h2>
        <table>
            <tr>
                <td>
                    <img src="img/featured1.jpg" alt="Featured Artwork">
                    <p>Artwork by: JennasArts</p>

                </td>
                <td>
                    <img src="img/featured2.jpg" alt="Featured Artwork">
                    <p>Artwork by: BobDoesArt</p>
                </td>
        <td>
                    <img src="img/featured3.jpg" alt="Featured Artwork">
                    <p>Artwork by: ArtSlayer69</p>
                </td>
            </tr>
        </table>
    </section>
    <footer>
        <p>&copy; 2024 Art Hive. All rights reserved.</p>
    </footer>
</body>
</html>
