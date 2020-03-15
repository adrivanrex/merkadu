<?php
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

$users = new ManageUsers();
$username = $_GET["username"];
$password = $_GET["password"];
$productID = $_GET["productID"];


session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'Content-Type');
header('Content-Type: application/json');

$loginCheck = $users->LoginUser($username,$password);

if($loginCheck == 1){
	
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;
	
	$productID = $users->removeProduct($productID);
	$data = (object) array('status' => 0,"data" => $productID);
	echo json_encode($data);

	
}else{
	session_destroy();
	$data = (object) array('status' => 0);
	echo json_encode($data);
}

?>