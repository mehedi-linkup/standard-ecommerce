<?php
require_once('db.php');
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn,'utf8');
$sql = "SELECT id,name,image,deleted_at FROM `categories` WHERE deleted_at is null ";
    $run = mysqli_query($conn,$sql);

    while($data = mysqli_fetch_assoc($run)){
        $id = $data["id"];
        $sub_categories = "SELECT * FROM `sub_categories` WHERE deleted_at is null and category_id = '$id' ";
        $s_c = [];
        $run2 = mysqli_query($conn,$sub_categories);
        while($data2 = mysqli_fetch_assoc($run2)){
            $s_c[] = $data2;
        }

        $data['sub_categories'] = $s_c;
        
    	$item[] = $data ;
    	$json = json_encode(array('contents'=>$item));
    }
    echo $json ;

  
?>