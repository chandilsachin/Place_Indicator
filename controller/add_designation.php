<?php
$name = $_GET["desig_name"];

include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
$command = "insert into designation values('".$name."')";
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
