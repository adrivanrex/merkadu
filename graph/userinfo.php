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


$checkLogin = $users->LoginUser($username,$password);


switch ($checkLogin) {
    case "1":
        $GetUserInfo = $users->GetUserInfo($username);
		$checkBalance = $users->checkBalance($username);
		$directReferalTotalBalance = $users->directReferalTotalBalance($username);
		$pointsLeft = $users->points($username,"left");
		$pointsRight = $users->points($username,"right");
		$data = (object) array('login' => 1,'details' => $GetUserInfo[0],'balance' =>$checkBalance,'directReferalTotalBalance' =>$directReferalTotalBalance,'pointsLeft' => $pointsLeft,'pointsRight' => $pointsRight);
		echo json_encode($data);

        break;
    case "0":
        $data = (object) array('login' => 0,"message" => "incorrect password");
		echo json_encode($data);
        break;
    case "2":
        $data = (object) array('login' => 2,"message" =>"account is locked due to 4 failed login attempts. try again after 2 minutes");
		echo json_encode($data);
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";
}



?>