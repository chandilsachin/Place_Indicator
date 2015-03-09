<?php
$id = $_GET["emp_id"];

include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
$command = "delete from current_place where emp_id = ".$id;
$connection->query($command);
$command = "delete from employee where id = ".$id;
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
