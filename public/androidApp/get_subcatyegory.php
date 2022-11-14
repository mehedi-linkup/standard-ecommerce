<?php
require_once('db.php');
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$pId=$_POST['category_id'];
//where category_id = '$pId'
mysqli_set_charset($conn,'utf8');
$sql = "SELECT * from sub_categories where category_id = '$pId ' AND deleted_at is null";
    $run = mysqli_query($conn,$sql);
    while($data = mysqli_fetch_assoc($run)){
    	$item[] = $data ;
    	$json = json_encode(array('contents'=>$item));
    }
    echo $json ;

  
?>