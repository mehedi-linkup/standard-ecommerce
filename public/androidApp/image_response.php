<?php 

	$baseURL = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
    require_once('db.php');
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($conn,'utf8');
	


	//creating the upload url 
	$upload_url = $baseURL . '/public/uploads/service/'; 
// 	echo $upload_url;
// 	exit;
	//response array 
	$response = array(); 
	

	
if($_SERVER['REQUEST_METHOD']=='POST'){
		
		if(isset($_FILES['image']['name'])){
			

			$fileinfo = pathinfo($_FILES['image']['name']);
			
			$fileName = $fileinfo['filename'];;
			
			$extension = $fileinfo['extension'];
			
			$upload_destination = './uploads/'.$_FILES['image']['name'];
			

			$file_path = $upload_url . $_FILES['image']['name']; 
			
			try{
				//saving the file 
				move_uploaded_file($_FILES['image']['tmp_name'], $upload_destination);
				$sql = "insert into `image_test` (`imageKey`) VALUES ('$file_path')";
				$conn->query($sql);

			}catch(Exception $e){
				$response['error']=true;
				$response['message']=$e->getMessage();
			}		

			echo json_encode($response);

		}else{
			$response['error']=true;
			$response['message']='Please choose a file';
		}
	}