<?php
error_reporting(0);
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

$users = new ManageUsers();
$username = $_GET["username"];
$password = $_GET["password"];
$deliveryID = $_GET["deliveryID"];



session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'Content-Type');
header('Content-Type: application/json');

$loginCheck = $users->LoginUser($username,$password);

if($loginCheck == 1){
$checkRiderStatus = $users->checkRiderStatus($deliveryID);
$data = (object) array('login' => 0,"data" => $checkRiderStatus);
		echo json_encode($data);
}else{
	
	session_destroy();
	$data = (object) array('login' => 0);
	echo json_encode($data);
}

?>