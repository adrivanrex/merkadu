<?php
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

$users = new ManageUsers();
$username = $_GET["username"];
$password = $_GET["password"];
$purchasedID = $_GET["purchasedID"];



session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'Content-Type');
header('Content-Type: application/json');

$loginCheck = $users->LoginUser($username,$password);

if($loginCheck == 1){
	
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;
	
	
		$verifyDelivery = $users->verifyDelivery($username,$purchasedID);
		if($verifyDelivery){
			$data = (object) array('status' => 0,"data" => $verifyDelivery);
			echo json_encode($data);
		}else{
			$data = (object) array('status' => 0,"data" => $verifyDelivery,"message" => "Seller is looking for Delivery Team..");
			echo json_encode($data);
		}
		



	
}else{
	session_destroy();
	$data = (object) array('status' => 0);
	echo json_encode($data);
}

?>