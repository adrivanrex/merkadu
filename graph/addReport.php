<?php
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'Content-Type');
header('Content-Type: application/json');



$users = new ManageUsers();
$username = $_GET["username"];
$password = $_GET["password"];
$reportDescription = $_GET["reportDescription"];
$productID = $_GET["productID"];


function antiXss($string){
	$string = str_replace("<","",$string);
	$string = str_replace(">","",$string);
	$string = str_replace("&lt;","",$string);
	$string = str_replace("&gt;","",$string);
	return $string;
}


$reportDescription = antiXss($reportDescription);
$productID = antiXss($productID);

$loginCheck = $users->LoginUser($username,$password);

if($loginCheck == 1){
	
	
	
	$getAccountStatus = $users->GetUserInfo($username);
	if($getAccountStatus){
		$bannedPostingProduct = false;

		if($getAccountStatus[0]["status"] == "bannedPostingProduct"){
			$bannedPostingProduct = true;
		}

		if($bannedPostingProduct == false){
			$addProduct = $users->reportProduct($username,$productID,$reportDescription);
			$data = (object) array('login' => 1,"status" => $addProduct);
			echo json_encode($data);
		}else{
			$data = (object) array('login' => 1,"status" => 2, "message" => "Your account is currently suspended from posting products");
			echo json_encode($data);
		}
	}



	
	

	
}else{
	session_destroy();
	$data = (object) array('login' => 0);
	echo json_encode($data);
}

?>