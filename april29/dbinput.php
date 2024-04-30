<?php
    include ("db_connection.php");
    session_start();

    $uid=$_POST['uid'];
    $email=$_POST['email'];
    $pwd=$_POST['pwd'];

$newentry = "INSERT INTO `users_tab`(`email`, `username`, `password`, `role`) VALUES('$email','$uid','$pwd','user')";
mysqli_query($connect, $newentry);


 
$newtable = "CREATE TABLE $uid (SID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, image LONGTEXT)";
mysqli_query($connect,$newtable);

    header("Location: index.php");
  exit();








///      if($userid != "cologne")// in the case username does not exist in tab
///        echo "Invalid Credentials. Would you like to try again?";
///      elseif($password != //cologne[password]) in the case password does not match user
///        echo "Invalid Credentials. Would you like to try again?";
///      else// in the case password matches the user
///        echo "Valid Credentials! Thank you for logging in.";


?>