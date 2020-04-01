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
$picture = $_GET["picture"];



function antiXss($string){
	$string = str_replace("<","",$string);
	$string = str_replace(">","",$string);
	$string = str_replace("&lt;","",$string);
	$string = str_replace("&gt;","",$string);
	return $string;
}


$picture = antiXss($picture);



$loginCheck = $users->LoginUser($username,$password);

if($loginCheck == 1){
	$verifyProfile = $users->verifyProfile($username,$picture);
	$data = (object) array('login' => 0,'verifyPicture' => 1);
	echo json_encode($data);
}else{
	session_destroy();
	$data = (object) array('login' => 0);
	echo json_encode($data);
}

?>