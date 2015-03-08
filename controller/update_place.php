<?php
$empid = $_GET["emp_id"];
$roomid = $_GET["room_id"];
include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
$command = "update current_place set room_id = ".$roomid.",time_of_entry = now() where emp_id = ".$empid;
$jsonObj = "{";	
if($connection->query($command)=== TRUE)
	$jsonObj .= "\"result\":1";
else
{	
	$jsonObj .= "\"result\":0,\"reason\":\"".$connection->error."\"";
}
$jsonObj .= "}";
echo $jsonObj;
$connection->close();

 ?>
