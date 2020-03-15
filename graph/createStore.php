<?php
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

$users = new ManageUsers();
$username = $_GET["username"];
$password = $_GET["password"];
$storeName = $_GET["storeName"];
$storeDescription = $_GET["storeDescription"];
$primaryPicture = $_GET["primaryPicture"];

$storeName = str_replace("<","",$storeName);
$storeName = str_replace(">","",$storeName);
$storeName = str_replace("&gt;","",$storeName);
$storeName = str_replace("&lt;","",$storeName);

$storeDescription = str_replace("<","",$storeDescription);
$storeDescription = str_replace(">","",$storeDescription);
$storeDescription = str_replace("&gt;","",$storeDescription);
$storeDescription = str_replace("&lt;","",$storeDescription);

session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'Content-Type');
header('Content-Type: application/json');

$loginCheck = $users->LoginUser($username,$password);
$checkIfStoreExist = $users->checkIfStoreExist($storeName);


if($loginCheck == 1){

	if($checkIfStoreExist == 0){
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		
		$createStore = $users->createStore($username,$storeName,$storeDescription,$primaryPicture);
		$data = (object) array('login' => 0,"status" => $createStore);
		echo json_encode($data);
	}else{
		$data = (object) array('login' => 0,"status" => 0,"message" => "Store Name already exist");
		echo json_encode($data);
	}
	
	

	
}else{
	session_destroy();
	$data = (object) array('login' => 0);
	echo json_encode($data);
}

?>