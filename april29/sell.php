    <!DOCTYPE html>
    <?php
    //session_start();

    //if(($_SESSION['role'] !="user"))
   // {
     // echo "You are not logged in. Please login to be able to sell. <a href='index.php'> Login Again</a>";
     // session_destroy();
     // header('location: index.php');
    //}

      ?>



<!---dont mess with code above -->


<?php

session_start();
include("db_connection.php");

$uid = $_SESSION['uid'];   

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sellArt"])) {
    // Call the sellArt function
    sellArt($connect);
}

function sellArt($connection) {
    // Retrieve form data
	$uid = $_SESSION['uid'];   

    $artName = $_POST['artist_name'];
    $description = $_POST['description'];
	$price = $_POST['price'];
    
    // Check if an image file is uploaded
    if (isset($_FILES['art_image']) && $_FILES['art_image']['error'] === UPLOAD_ERR_OK) {
        // Get the image data as base64 encoded string
        $image = base64_encode(file_get_contents($_FILES['art_image']['tmp_name']));
        
        // Insert data into the database
        $sql = "INSERT INTO marketplace (seller, description, image, price) VALUES ('$artName', '$description', '$image', '$price')";
        $newart = "INSERT INTO $uid(image) VALUES('$image')";
		
        // Execute the SQL query
        if(mysqli_query($connection, $sql)&& mysqli_query($connection, $newart)) {
            // Display alert
            echo "<script>alert('Art Submitted');</script>";
            // Redirect to Marketplace.php
            echo "<script>window.location = 'Marketplace.php';</script>";
        } else {
            // Display error alert
            echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
            // Redirect to Marketplace.php
            echo "<script>window.location = 'Marketplace.php';</script>";
        }
    }
	
	
}
?>






<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Art</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
			background-image: url('img/bee_hive_pattern.png');
            background-size: cover;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="file"] {
            margin-top: 20px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>




<body>
<center>
    <h2>Sell Your Art!</h2>
</center>
    <form id="addArtForm" method="post" action="" enctype="multipart/form-data">
    <label for="artist_name">Name of Your Art:</label>
    <input type="text" id="artist_name" name="artist_name" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required></textarea>
	
	<label for="price">Price:</label>
    <input type="text" id="price" name="price" required>


    <label for="art_image">Art Image (as jpg):</label>
    <input type="file" id="art_image" name="art_image" accept="image/*" required>

    <button type="submit" class="btn btn-primary" name="sellArt">Sell Art</button>
</form>
</body>
</html>