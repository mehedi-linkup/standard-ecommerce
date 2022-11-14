<?php
require_once('db.php');
$conn = mysqli_connect($servername, $username, $password, $dbname);
// sales master
    $data = json_decode($_POST['sales']);
    $cart = json_decode($_POST['cart']);
mysqli_set_charset($conn,'utf8');
    
    $customer_id = $data->customer_id;
    $customer_name = $data->customer_name;
    $customer_mobile = $data->customer_mobile;
    $customer_email = $data->customer_email;
    $shipping_address = $data->shipping_address;
    $billing_address = $data->billing_address;
    $vat_amount = $data->vat_amount;
    $shipping_cost = $data->shipping_cost;
    $discount_amount = $data->discount_amount;
    $service_charge = $data->service_charge;
    $total_amount = $data->total_amount;
    $status = $data->status;
    $order_note = $data->order_note;
    // echo(json_encode($data));
    // exit;

    $branchId = 1;
    $branchNo = strlen($branchId) < 10 ? '0' . $branchId : $branchId;
    $invoice = date('y') . $branchNo . "00001";
    $year = date('y');
    $invoiceSql = "select * from orders o where o.invoice_no like '$year%'";
    $sales = mysqli_query($conn, $invoiceSql);
    $count = mysqli_num_rows($sales);
    if($count > 0){
        $row = mysqli_fetch_assoc($sales);
        $newSalesId = $row['invoice_no'] + 1;
        $zeros = array('0', '00', '000', '0000');
        $invoice = date('y') . $branchNo . (strlen($newSalesId) > count($zeros) ? $newSalesId : $zeros[count($zeros) - strlen($newSalesId)] . $newSalesId);
	}

$sql = "
    INSERT INTO orders (
    invoice_no)
    values('$invoice')";

$run = mysqli_query($conn,$sql);
// echo (json_encode($run));
// exit;
// $salesMasterId = mysqli_insert_id($conn);


// // sales details

// foreach($cart as $value) {
//     $branchId = 1;
    
//     $salesDetails = "insert into  order_details (order_id, product_id, product_name, price, quantity, color_id, size_id, total_price)
//         values('$salesMasterId', '$value->productId', '$value->product_name', '$value->price', '$value->quantity', '$value->color_id','$value->size_id',$value->total_price)
//     ";
//     mysqli_query($conn,$salesDetails);
// }


if($run==true){
	echo"Successfull";
//	echo json_encode($cart);
}
else{
    echo "Failed";
}

?>