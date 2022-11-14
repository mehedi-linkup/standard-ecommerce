<?php
require_once('db.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);
$res = new stdClass();
   $userName= trim($_POST["name"]);
      $userphone= trim($_POST["phone"]);
         $userAddress= trim($_POST["address"]);
   $userPassword = trim($_POST["password"]);
   
$sql = "
    INSERT INTO customers (
        name, phone, address, password
    )
    values('$userName', '$userphone','$userAddress','$userPassword')
";

    $run = mysqli_query($conn,$sql);
if($run==true){
	    $row = mysqli_fetch_assoc($run);
		 $res->success = 'success';
	    echo json_encode($res);
}
else{
    echo "Failed";
}
?>