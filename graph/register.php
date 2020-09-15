<?php
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

$users = new ManageUsers();

header('Access-Control-Allow-Origin: *');

function antiXss($string){
	$string = str_replace("<","",$string);
	$string = str_replace(">","",$string);
	$string = str_replace("&lt;","",$string);
	$string = str_replace("&gt;","",$string);
	return $string;
}


$username = $_GET["username"];
$password = $_GET["password"];
$firstName = antiXss($_GET["firstName"]);
$middleName = antiXss($_GET['middleName']);
$lastName = antiXss($_GET['lastName']);
$mobileNumber = antiXss($_GET['mobileNumber']);
$email = antiXss($_GET['email']);

/**
$sponsor = $_GET['sponsor'];
$upline = $_GET['upline'];
$placement = $_GET['placement'];
$registrationCode = $_GET['registrationCode'];
**/

$username = antiXss($username);

$paypal = "none";
$dateTime = date("H:i:s");


$country = antiXss($_GET["country"]);
$continent = antiXss($_GET["continent"]);
$currency = $_GET["currency"];
$state = antiXss($_GET["state"]);

/**
$registrationCode = $_GET["registrationCode"];

**/

$city = antiXss($_GET["city"]);
$streetAddress = antiXss($_GET["streetAddress"]);
$secondAddress = antiXss($_GET["secondAddress"]);
$postalCode = $_GET["postalCode"];
$referalCompany = $_GET["referalCompany"];

$bdayYear = antiXss($_GET["bdayYear"]);
$bdayMonth = antiXss($_GET["bdayMonth"]);
$bdayDay = antiXss($_GET["bdayDay"]);
$gender = antiXss($_GET["gender"]);

/**
if (is_numeric($bdayYear)) { } else { 
	exit(); } 
if (is_numeric($bdayMonth)) { } else { 
	exit(); } 
if (is_numeric($bdayDay)) { } else { 
	exit(); } 
**/


header('Content-Type: application/json');

$directReferalAmount = 500;


$checkUser = $users->CheckUserExist($username);
//var_dump($checkUpline);
if($checkUser == 0){

	$registration = $users->registerUsers($username,$password,$firstName,$middleName,$lastName,$mobileNumber,$email,$streetAddress,$secondAddress,$postalCode,$city,$bdayYear,$bdayMonth,$bdayDay,$gender,$country,$continent,$currency,$state);
	$data = (object) array('registration' => 1,'message' => "success");
	echo json_encode($data);

}else{
	$data = (object) array('registration' => 0,'message' => "username already taken");
	echo json_encode($data);
}



?>