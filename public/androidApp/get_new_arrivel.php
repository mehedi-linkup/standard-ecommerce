<?php
require_once('db.php');
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn,'utf8');
$sql = "SELECT id,code,color_id,description,discount,category_id,image,name,price,size_id,short_details,slug,thum_image,deleted_at FROM `products` ORDER BY rand() LIMIT 12";
    $run = mysqli_query($conn,$sql);
    while($data = mysqli_fetch_assoc($run)){
    	$item[] = $data ;
    	$json = json_encode(array('contents'=>$item));
    }
    echo $json ;

  
?>