<?php
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

$users = new ManageUsers();
$username = $_GET["username"];
$password = $_GET["password"];
$profileToVerify = $_GET["profileToVerify"];


session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'Content-Type');
header('Content-Type: application/json');

$loginCheck = $users->LoginUser($username,$password);

if($loginCheck == 1){
$roleCheck = $users->roleCheck($username);
	if($roleCheck[0]["role"] == "admin"||$roleCheck == "moderator"){
		
		$declineProfileVerification = $users->declineProfileVerification($profileToVerify);
		//echo json_encode($verifyID);
		if($declineProfileVerification == 1){
			$data = (object) array('login' => 0,"status" => $declineProfileVerification,"message" =>"declined");
				echo json_encode($data);
		}
	}


	

	
}else{
	session_destroy();
	$data = (object) array('login' => 0);
	echo json_encode($data);
}

?>