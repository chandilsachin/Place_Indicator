<?php
$id = $_GET["emp_id"];
$name = $_GET["emp_name"];
$designation = $_GET["emp_designation"];
$dept = $_GET["emp_dept"];
$room = $_GET["emp_room"];
$email = $_GET["emp_emailid"];

include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
$command = "update employee set name = '".$name."',designation = '".$designation."',dept = '".$dept."',room = ".$room.",emailid = '".$email."' where id = ".$id;
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
