<?php
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

$users = new ManageUsers();
$username = $_GET["username"];
$password = $_GET["password"];
$productName = $_GET["name"];
$productDescription = $_GET["description"];
$productPrimaryPicture = $_GET["picture"];
$productQuanitity = $_GET["quantity"];
$productUnitPrice = $_GET["unitPrice"];
$productID = $_GET["productID"];





$productName = str_replace("<","",$productName);
$productName = str_replace(">","",$productName);
$productName = str_replace("&gt;","",$productName);
$productName = str_replace("&lt;","",$productName);

$productDescription = str_replace("<","",$productDescription);
$productDescription = str_replace(">","",$productDescription);
$productDescription = str_replace("&gt;","",$productDescription);
$productDescription = str_replace("&lt;","",$productDescription);

session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'Content-Type');
header('Content-Type: application/json');

$loginCheck = $users->LoginUser($username,$password);


if($loginCheck == 1){

	
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		
		$editProduct = $users->editProduct($username,$productName,$productDescription,$productQuanitity,$productUnitPrice,$productPrimaryPicture,$productID);
		$data = (object) array('login' => 0,"status" => $editProduct);
		echo json_encode($data);
	
	
	

	
}else{
	session_destroy();
	$data = (object) array('login' => 0);
	echo json_encode($data);
}

?>