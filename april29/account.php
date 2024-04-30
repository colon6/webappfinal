  <!DOCTYPE html>
  <?php
  session_start();
  include ("db_connection.php");

  $uid = $_SESSION['uid'];    


   $account_check ="SELECT * FROM users_tab WHERE username='$uid'";
   $account_result=$connect->query($account_check);

   while ($row_product = $account_result->fetch_assoc())
    {
      if ($row_product['username'] == $uid)///check this
      {
      $email = $row_product["email"];
        $username = $row_product["username"];
        $password = $row_product["password"];
        $role = $row_product["role"];

    }
    }
	
	
	
	
	
	$count=1;
	$personalwork = "SELECT * FROM $uid";
	$result_personalwork = $connect->query($personalwork);
	$result = mysqli_query($connect, $personalwork);

    ?>


  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Art Hive - Account</title>
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
              text-align: left;
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
      </header>
      <div class="navbar">
          <a href="Homepage.php">Home</a>
          <a href="Marketplace.php">Marketplace</a>
          <a href="sell.php">Sell</a>
      <a href="posts.php">Posts</a>
          <a href="account.php">Account</a>
      </div>

      <section id="profile">
          <h2>Profile Information</h2>
          <p>Username: <?php echo $username?> </p>
          <p>Email: <?php echo $email?></p>
          <p>Role: <?php echo $role?></p>
          <p>Member Since: January 1967</p>
      </section>

      <section id="settings">
          <h2>Settings</h2>
          <p><a href="#">Edit Profile</a></p>
          <p><a href="#">Change Password</a></p>
          <p><a href="#">Privacy Settings</a></p>
      </section>

      <section id="activity">
          <h2>Personal Artwork</h2>
          <table>
              <tr>
			  <?php
			     if (mysqli_num_rows($result) > 0)
			{

			  while ($row_product = $result_personalwork->fetch_assoc())
			  {
				  
				?>
				
                  <td><?php echo '<img src="data:image/jpg;base64,' . $row_product['image'] . '" alt="Artwork">'; ?>
</td>
                  

              
			  
			  
			  <?php
				if ($count>=3)
				{
					echo "</tr>><tr>";
					$count =1;
				}
				else
				{
					$count++;
				}
				
			  }
			  
			  
			}

			else{     echo '<p>No works available.</p>';}

			  ?>
			
				 
					 
					 
			  
			  

          </table>
      </section>



  
  </body>
  </html>
