<?php
error_reporting(0);

include_once('../class/class.manageUsers.php');
$users = new ManageUsers();
$month = date('m');

$year = date("Y"); 
$city = "iligan";


$generateMonthlyBill = $users->generateMonthlyBill($month,$year,$city);

?>