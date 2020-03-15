<?php
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

$users = new ManageUsers();
$username = $_GET["username"];
$password = $_GET["password"];



session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'Content-Type');
header('Content-Type: application/json');

$loginCheck = $users->LoginUser($username,$password);

if($loginCheck == 1){
$acceptDelivery = $users->completedList($username);

if($acceptDelivery == 1){
	$data = (object) array('login' => 0,"status" => $acceptDelivery,"message" =>"success");
		echo json_encode($data);
}else{
	$data = (object) array('login' => 0,"status" => $acceptDelivery,"message" => "delivery code is not correct");
		echo json_encode($data);
}

	

	
}else{
	session_destroy();
	$data = (object) array('login' => 0);
	echo json_encode($data);
}

?>