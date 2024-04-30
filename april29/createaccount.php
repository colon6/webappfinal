<!DOCTYPE html>


<?php session_start(); 
  include ("db_connection.php");

  $x = rand(1,3);

  $feature_check= "SELECT * FROM feature_tab WHERE SID = '$x'";
  $feature_result= $connect->query($feature_check);

  while($row_product = $feature_result->fetch_assoc())
  {
    $feature_image = $row_product["image"];
  }



  ?>


  <head>

  <title>arthive_accountcreation</title>

  <style>




  .behindlogin{
  background-image: url('img/groupcombs.png');
  width: 39%;
  height: 100%;
  opacity: 1;
  position: absolute;
  }


  .login-div{
  font-family: monospace;
  font-size: 30px;
  width: 40%;
  height: 100%;
  color: #ffffff;
  background-image: linear-gradient( rgba(0,0,0,.5), rgba(0,0,0,1));
  margin: 0px;
  position: absolute;
  top: 0px;
  left: 0px;
  }

  .caption{
  font-family: monospace;
  font-size: 15px;



  }
  </style>
  </head>


  <body style="background-image: url('<?php echo $feature_image?>');
  background-repeat: no-repeat;
  background-size: cover">
  <div class="behindlogin"></div>

  <div id="loginForm" class = "login-div" >
  <center>
  <h1> welcome to the ARTHIVE </h1>
  <text class="caption">please create an account</text><br><br>
  <form name="login-form" method="POST" action="dbinput.php">
    Username: <input type="text" name="uid" id="uid" /><br><br>
    Email: <input type="text" name="email" id="email" /><br><br>
    Password: <input type="text" name="pwd" id="pwd" /><br><br>

    <input type="submit" value="create" />
    <input type="submit" value="reset" />
  </form>
  </center>


  </div>




  </body>


</html>