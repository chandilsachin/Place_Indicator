<?php 
$filter = $_GET["dept_id"];
include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
$command = "delete from department";
$command .= " where dept='".$filter."'";

$jsonObj = "{";	
$result = $connection->query($command);
$len = $result->num_rows;
if($result === TRUE)
{
	$jsonObj .= "\"result\":1";
}
else
	$jsonObj .= "\"result\":0,\"reason\":\"".$connection->error."\"";
$jsonObj .= "}";
echo $jsonObj;
$connection->close();
?>