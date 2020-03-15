<?php
include_once('../class/class.manageUsers.php');
$datetime = date_create()->format('Y-m-d H:i:s');

$users = new ManageUsers();

session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'Content-Type');
header('Content-Type: application/json');


	$deliveryList = $users->deliveryList();
	
	$data = (object) array('status' => 0,"data" => $deliveryList);
	echo json_encode($data);

	

?>