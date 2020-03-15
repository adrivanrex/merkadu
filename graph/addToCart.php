<?php
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

$users = new ManageUsers();
$username = $_GET["username"];
$password = $_GET["password"];
$productID = $_GET["productID"];
$quantity = $_GET["quantity"];
$quantity = abs($quantity);



session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'Content-Type');
header('Content-Type: application/json');

$loginCheck = $users->LoginUser($username,$password);

if($loginCheck == 1){

	
	$productInfo = $users->getProductInfo($productID);

	if($productInfo){
		$productUsername =  $productInfo[0]["username"];
		$productName = $productInfo[0]["name"];
		$productDescription = $productInfo[0]["description"];
		$productPicture = $productInfo[0]["picture"];
		$productID = $productInfo[0]["id"];
		$storeName = $productInfo[0]["storeName"];
		$productUnitPrice = $productInfo[0]["unitPrice"];
		$productOwner = $productInfo[0]["productOwner"];
		$totalPrice = $productUnitPrice * $quantity;
		$totalPrice = abs($totalPrice);
		$productUnitPrice = abs($productUnitPrice);
		if($username !== $productUsername){
			$addToCart = $users->addToCart($username,$productName,$productDescription,$productPicture,$productID,$storeName,$productUnitPrice,$quantity,$totalPrice,$productOwner);
			$data = (object) array('login' => 0,"status" => $addToCart);
			echo json_encode($data);
		}else{
			$data = (object) array('login' => 0,"message" => "Invalid Buy");
			echo json_encode($data);
		}
		
	}else{
		$data = (object) array('login' => 0,"message" => "Invalid Product");
		echo json_encode($data);
	}
	

	

	
}else{
	session_destroy();
	$data = (object) array('login' => 0);
	echo json_encode($data);
}

?>