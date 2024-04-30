<?php
	session_start();
    include ("db_connection.php");

    $uid=$_POST['uid'];
    $pwd=$_POST['pwd'];





  $authentication_check ="SELECT * FROM users_tab WHERE username='$uid' AND password='$pwd'";
  $authentication_result=$connect->query($authentication_check);




 // while ($row_product = $authentication_result->fetch_assoc())
 // {
 //   if ($row_product['username'] == $uid AND $row_product['password'])///check this
 //   {
 //     print "valid credentials.";	
 //     $_SESSION['uid']=$uid;
 //     $_SESSION['pwd']=$pwd;
//      $_SESSION['role'] = $row_product["role"];
//
//
//      header("Location: Homepage.php");
 //     exit();
//    }
//
 //   else{   
 //     header("Location: sell.php");
//      exit();
//    }		
 // }



if ($row_product = $authentication_result->fetch_assoc()) {
  
    if ($row_product['password'] == $pwd) {
        $_SESSION['uid'] = $uid;
        $_SESSION['role'] = $row_product["role"];
        header("Location: Homepage.php");
        exit();
    } else {
        header("Location: createaccount.php");
        exit();
    }
} else {

    header("Location: createaccount.php");
    exit();
}

///      if($userid != "cologne")// in the case username does not exist in tab
///        echo "Invalid Credentials. Would you like to try again?";
///      elseif($password != //cologne[password]) in the case password does not match user
///        echo "Invalid Credentials. Would you like to try again?";
///      else// in the case password matches the user
///        echo "Valid Credentials! Thank you for logging in.";


?>