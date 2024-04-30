<!DOCTYPE html>
<?php
//session_start();
//include ("db_connection.php");

//if(($_SESSION['role'] !="user"))
//{ echo "<script>alert('You are not allowed to access this page. You are now signed out.');</script>";
  //$msg = "You are not allowed to access this page. You are now signed out.";
 // echo "<script type='text/javascript'>alert('$msg');</script>";
 // echo '<script>alert( "You are not allowed to access this page. You are now signed out.")</script>';
  //session_destroy();
 // header('Location: createaccount.php');
//}


?>





<?php

include("db_connection.php");

// fetch marketplace from the database
$sql = "SELECT * FROM marketplace"; 
$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Hive - Marketplace</title>
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
		.cart-icon {
            position: absolute;
            top: 20px;
            right: 20px;
        }
		#cart-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 50px;
            cursor: pointer;
        }
		.cart-content {
            display: none;
            position: absolute;
            top: 80px;
            left: 1800px;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
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
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .post {
            background-color: #fff;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .post img {
			max-width: 300px;
			max-height: 300px;
			cursor: pointer; 
			}
        
        .post-description {
            flex: 1;
        }
        .post-description h3 {
            margin: 0 0 10px;
            color: #333;
        }
        .post-description h4 {
            margin: 5px 0;
            color: #666;
        }
        .post-description p {
            margin: 0;
            color: #777;
        }
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        .popup img {
			width: 600px; 
			height: 400px;
			object-fit: contain; 
}
        .popup.active {
            display: flex;
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
	<img id="cart-icon" src="img/cart.png" alt="Cart" onclick="displayCart()">
</header>
<div class="navbar">
    <a href="Homepage.php">Home</a>
    <a href="Marketplace.php">Marketplace</a>
    <a href="sell.php">Sell</a>
    <a href="posts.php">Posts</a>
    <a href="account.php">Account</a>
</div>
<div class="container">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="post">';
            // Diplay image retrieved from LONGTEXT
            echo '<img src="data:image/jpg;base64,' . $row['image'] . '" alt="Artwork" onclick="togglePopup(this.src)">';
            echo ' <div class="post-description">';
            echo ' <h3>Art Name: ' . $row['seller'] . '</h3>';
            echo ' <h4>Description:</h4>';
            echo ' <p>' . $row['description'] . '</p>';
            echo ' <h4>Price:</h4>';
            echo ' <p>' . $row['price'] . '$</p>';
            // Add a button to add this item to cart
            echo ' <button onclick="addItemToCart(\'' . $row['seller'] . '\', ' . $row['price'] . ')">Add to Cart</button>';
            echo ' </div>';
            echo ' </div>';  
        }
    } else {
        echo '<p>No posts available.</p>';
    }

	
    ?>
</div>

<div class="popup" id="popup">
    <img id="popupImage" src="" alt="Popup Image" onclick="togglePopup()">
</div>

<div class="cart-content" id="cart-content">
    <button onclick="prepareCheckout()">Proceed to Checkout</button>
</div>

<script>
    function togglePopup(src) {
        var popup = document.getElementById('popup');
        var image = document.getElementById('popupImage');

        if (popup.classList.contains('active')) {
            popup.classList.remove('active');
            image.src = '';
        } else {
            popup.classList.add('active');
            image.src = src;
        }
    }

      function addItemToCart(itemName, itemPrice) {
		var cartContent = document.getElementById('cart-content');
		var item = document.createElement('div');
		item.classList.add('cart-item');
		item.dataset.name = itemName;
		item.dataset.price = itemPrice;
		item.textContent = itemName + ' - $' + itemPrice;
		cartContent.appendChild(item);
}

    function displayCart() {
        var cartContent = document.getElementById('cart-content');
        if (cartContent.style.display == 'block') {
            cartContent.style.display = 'none';
        } else {
            cartContent.style.display = 'block';
        }
    }
	
	function prepareCheckout() {
		var items = document.querySelectorAll('.cart-item');
		var itemNames = [];
		var itemPrices = [];

		items.forEach(function(item) {
			itemNames.push(item.dataset.name);
			itemPrices.push(item.dataset.price);
		});

		//redirects to checkout page and carries over the name and price
		window.location.href = 'checkout.php?itemNames=' + itemNames.join(',') + '&itemPrices=' + itemPrices.join(',');
	}
</script>
</body>
</html>