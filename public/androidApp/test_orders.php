<?php

// if (mysqli_query($conn, $sql)) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }
require_once('db.php');
$conn = mysqli_connect($servername, $username, $password, $dbname);

   $data = json_decode($_POST['sales']);
    $cart = json_decode($_POST['cart']);
     
     

    
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
    //  echo(json_encode($cart));
    //  exit;

    $branchId = 1;
    $branchNo = strlen($branchId) < 6 ? '0' . $branchId : $branchId;
    $invoice = date('y') . $branchNo . "01";
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
	
	
    $last_invoice_no ="select * from orders where o.invoice_no'";
    if(count($last_invoice_no) > 0){
        $invoice_no = $last_invoice_no[0] + 1;
    } else {
        $invoice_no = date('ymd') .'000001';
    }
// 	echo json_encode($invoice);
// 	exit;


$sql = "INSERT INTO orders (invoice_no,customer_id, customer_name, customer_mobile, customer_email, shipping_address, billing_address,
        vat_amount,shipping_cost,discount_amount, service_charge,
        total_amount, status, order_note)
    values('$invoice', '$customer_id','$customer_name','$customer_mobile',
'$customer_email','$shipping_address','$billing_address','$vat_amount','$shipping_cost','$discount_amount',
'$service_charge','$total_amount','$status','$order_note')";

$run = mysqli_query($conn,$sql);

$salesMasterId = mysqli_insert_id($conn);


// sales details

foreach($cart as $value) {
    $salesDetails = "insert into  order_details (order_id, product_id, product_name, price, quantity, color_id, size_id, total_price)
        values('$salesMasterId', '$value->productId', '$value->product_name', '$value->price', '$value->quantity', '$value->color_id','$value->size_id',$value->total_price)
    ";
    mysqli_query($conn,$salesDetails);
}
if($run==true){
	echo"Successfull";
//	echo json_encode($cart);
}
else{
    echo "Failed";
}
?>