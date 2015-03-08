<?php
/*
error codes
0 - connection not stablished.
1 for success
*/

$name = $_GET['room_name'];
$no = $_GET["room_telecom_no"];
include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
if(!$connection)
	echo "Connected";
$command = "insert into room (name,telecom_no) values('".$name."',".$no.")";
$jsonObj = "{";	
if($connection->query($command)=== TRUE)
	$jsonObj .= "\"result\":1";
else
{	
	$jsonObj .= "\"result\":0,\"reason\":\"".$connection->error."\"'";
}
$jsonObj .= "}";
echo $jsonObj;
$connection->close();
 ?>