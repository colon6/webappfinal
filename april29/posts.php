<?php
session_start();
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["postId"]) && isset($_POST["action"])) {
    $postId = $_POST["postId"];
    $action = $_POST["action"];
    $column = ""; // initialize the column name variable

    // determine which column to update based on the action
    switch ($action) {
        case "like":
            $column = "likes";
            break;
        case "love_it":
            $column = "love_it";
            break;
        case "great":
            $column = "great";
            break;
        case "ok":
            $column = "ok";
            break;
        case "bad":
            $column = "bad";
            break;
        default:
            // handle invalid action
            echo "Invalid action.";
            exit; // stop  for invalid actions
    }

    // udate the specified column in the database
    if ($column) {
        $sql = "UPDATE posts SET $column = CASE WHEN $column = 0 THEN 1 ELSE 0 END WHERE sid = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $postId);
        mysqli_stmt_execute($stmt);
    }
}
// fetch posts from the database
$sql = "SELECT * FROM posts"; 
$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Hive - Posts</title>
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
        .post {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .post img {
            max-width: 50%;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .post-description {
            float: right;
            width: 45%;
            padding-left: 20px;
        }
        .likes {
            color: #888;
            font-size: 14px;
        }
        .react-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
            display: none; 
        }
        .reaction-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
            position: relative;
        }
        .reaction-button span {
            position: absolute;
            top: -15px;
            right: -15px;
            background-color: red;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .like-button {
            background-color: #FF0000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        .toggle-reacts {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .toggle-reacts:hover {
            background-color: #45a049;
        }
        .reaction-count {
            margin-bottom: 10px;
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
        .add-post-button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 0px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            display: inline-block;
        }
        .add-post-button:hover {
            background-color: #45a049;
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
    <center>
        <a href="post_creation.php" class="add-post-button">Add Post</a>
    </center>
    
    <?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="post">';
        // Display image retrieved from LONGTEXT
        echo '<img src="data:image/jpg;base64,' . $row['art'] . '" alt="Artwork">';
        echo '<div class="post-description">';
        echo '<h3>Artist: ' . $row['artist'] . '</h3>';
        echo '<h4>Description:</h4>';
        echo '<p>' . $row['des'] . '</p>';
        echo '</div>';
        echo '<div class="post-actions">';
		
        // Display likes count
        echo '<div class="likes">' . $row['likes'] . ' Likes</div>';
        // Like button form
        echo '<form method="post">';
        echo '<input type="hidden" name="postId" value="' . $row['SID'] . '">';
        echo '<button class="like-button" name="action" value="like">Like</button>';
        echo '</form>';
		
        // Display reaction counts and buttons
        // Love It
        echo '<form method="post" style="display:inline;">';
        echo '<button class="reaction-button" name="action" value="love_it">Love It! (' . $row['love_it'] . ')</button>';
        echo '<input type="hidden" name="postId" value="' . $row['SID'] . '">';
        echo '</form>';
		
        // Great
        echo '<form method="post" style="display:inline;">';
        echo '<button class="reaction-button" name="action" value="great">Great! (' . $row['great'] . ')</button>';
        echo '<input type="hidden" name="postId" value="' . $row['SID'] . '">';
        echo '</form>';
		
        // Looks Ok
        echo '<form method="post" style="display:inline;">';
        echo '<button class="reaction-button" name="action" value="ok">Looks Ok (' . $row['ok'] . ')</button>';
        echo '<input type="hidden" name="postId" value="' . $row['SID'] . '">';
        echo '</form>';
		
        // Could Use Work
        echo '<form method="post" style="display:inline;">';
        echo '<button class="reaction-button" name="action" value="bad">Could Use Work (' . $row['bad'] . ')</button>';
        echo '<input type="hidden" name="postId" value="' . $row['SID'] . '">';
        echo '</form>';
        echo '</div>'; 
        echo '</div>'; 
    }
} else {
    echo '<p>No posts available.</p>';
}
?>
</div>
<script>
    function toggleReacts(sid) {
        var reactSection = document.getElementById('react-section-' + sid);
        if (reactSection.style.display == 'none') {
            reactSection.style.display = 'block';
        } else {
            reactSection.style.display = 'none';
        }
    }

    function react(postId, reaction) {
    var counter = document.getElementById(reaction + '-counter-' + postId);
    counter.textContent = parseInt(counter.textContent) + 1;
}

</script>
</body>
</html>
