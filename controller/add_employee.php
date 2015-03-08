<?php
$name = $_GET["emp_name"];
$designation = $_GET["emp_designation"];
$dept = $_GET["emp_dept"];
$room = $_GET["emp_room"];
$email = $_GET["emp_emailid"];

include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
$command = "insert into employee (name,designation,dept,room,emailid) values('".$name."','".$designation."','".$dept."',".$room.",'".$email."')";
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
