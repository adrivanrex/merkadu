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
$productName = $_GET["productName"];
$productDescription = $_GET["productDescription"];
$picture = $_GET["picture"];
$storeName = $_GET["storeName"];
$unitPrice = $_GET["unitPrice"];
$quantity = $_GET["quantity"];
$unitPrice = abs($unitPrice);



function antiXss($string){
	$string = str_replace("<","",$string);
	$string = str_replace(">","",$string);
	$string = str_replace("&lt;","",$string);
	$string = str_replace("&gt;","",$string);
	return $string;
}


$productName = antiXss($productName);
$productDescription = antiXss($productDescription);
$picture = antiXss($picture);
$storeName = antiXss($storeName);
$quantity = abs($quantity);


$loginCheck = $users->LoginUser($username,$password);

if($loginCheck == 1){
	
	
	
	$getAccountStatus = $users->GetUserInfo($username);
	if($getAccountStatus){
		$bannedPostingProduct = false;

		if($getAccountStatus[0]["status"] == "bannedPostingProduct"){
			$bannedPostingProduct = true;
		}

		if($bannedPostingProduct == false){
			$addProduct = $users->addProduct($username,$productName,$productDescription,$picture,$storeName,$unitPrice,$quantity);
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