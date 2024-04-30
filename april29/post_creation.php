<!DOCTYPE html>


<?php
session_start();

include("db_connection.php");

$uid = $_SESSION['uid'];   

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addArt"])) {
    // Call the addArt function
    addArt($connect);
}

function addArt($connection) {
    // Retrieve form data
	$uid = $_SESSION['uid'];   
    $artName = $_POST['artist_name'];
    $description = $_POST['description'];
	$like = 0;
    $love = 0;
	$great = 0;
	$ok = 0;
	$bad = 0;
    // Check if an image file is uploaded
    if (isset($_FILES['art_image']) && $_FILES['art_image']['error'] === UPLOAD_ERR_OK) {
        // Get the image data as base64 encoded string
        $image = base64_encode(file_get_contents($_FILES['art_image']['tmp_name']));
        
        // Insert data into the database
        $sql = "INSERT INTO posts (artist, des, art,likes, love_it, great, ok, bad) 
                VALUES ('$artName', '$description', '$image','$like', '$love', '$great', '$ok', '$bad')";
        $newart = "INSERT INTO $uid(image) VALUES('$image')";

        // Execute the SQL query
        if(mysqli_query($connection, $sql)&& mysqli_query($connection, $newart) ) {
            // Display alert
            echo "<script>alert('Art Submitted');</script>";
            // Redirect to posts.php
            echo "<script>window.location = 'posts.php';</script>";
        } else {
            // Display error alert
            echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
            // Redirect to posts.php
            echo "<script>window.location = 'posts.php';</script>";
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
    <h2>Add Your Art!</h2>
</center>
    <form id="addArtForm" method="post" action="" enctype="multipart/form-data">
    <label for="artist_name">Artist Name:</label>
    <input type="text" id="artist_name" name="artist_name" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required></textarea>

    <label for="art_image">Art Image (as jpg):</label>
    <input type="file" id="art_image" name="art_image" accept="image/*" required>

    <button type="submit" class="btn btn-primary" name="addArt">Add Art</button>
</form>
</body>
</html>