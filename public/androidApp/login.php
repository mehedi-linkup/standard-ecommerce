<?php
require_once('db.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);
$res = new stdClass();
   $userName= trim($_POST["phone"]);
   $userPassword = trim($_POST["password"]);
   
    $sql = "SELECT * FROM `customers`  WHERE phone = '$userName' AND password = '$userPassword'";

    $run = mysqli_query($conn,$sql);
	if($run->num_rows > 0){
	    $row = mysqli_fetch_assoc($run);
	    $res->user = $row;
	   // $res->id=$row['id'];
	    $res->success = 'Login Success';
	    echo json_encode($res);
	}
	
	else{
  		 echo "user not found ";
	}
?>