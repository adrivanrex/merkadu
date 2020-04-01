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
$newPassword = $_GET["newPassword"];
$verifyNewPassword = $_GET["verifyNewPassword"];


if($password == null ||$password == "undefined"){
	$data = (object) array('login' => 0,"message"=>"Please input last password");
				echo json_encode($data);
}else{
	if($newPassword == "undefined" || $newPassword == "undefined"){
		$data = (object) array('login' => 0,"message"=>"Please input new password");
					echo json_encode($data);
	}else{

		if($verifyNewPassword == null || $verifyNewPassword == "undefined"){
			$data = (object) array('login' => 0,"message"=>"Please input verify new password");
						echo json_encode($data);
		}else{
			if($verifyNewPassword == $newPassword){
				$verifyLogin = $users->LoginUser($username,$password);
				if($verifyLogin == 1){
						if($newPassword == $verifyNewPassword){
							$updatePassword = $users->updatePassword($username,$password,$newPassword);
							if($updatePassword == 1){
								$data = (object) array('login' => 1,"message"=>"Success");
								echo json_encode($data);
							}
				}
			}else{
				$data = (object) array('login' => 0,"message"=>"Last password is inccorect");
						echo json_encode($data);
			}
		}else{
			$data = (object) array('login' => 0,"message"=>"Verify password is not identical with new password");
						echo json_encode($data);

		}

	}
}
}





		







?>