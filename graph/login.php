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

$loginCheck = $users->LoginUser($username,$password);

$checkBalance = $users->checkBalance($username);

if($loginCheck == 1){
	
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;
	

	$data = (object) array('login' => 1);
	echo json_encode($data);
}else{
	session_destroy();
	$data = (object) array('login' => 0);
	echo json_encode($data);
}


?>