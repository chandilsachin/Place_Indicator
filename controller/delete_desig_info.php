<?php 
$filter = $_GET["desig_name"];
include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
$command = "delete from designation";
if(	strcmp($filter, ""))
	$command .= " where designation='".$filter."'";

$jsonObj = "{";	
$result = $connection->query($command);
$len = $result->num_rows;
if($result === TRUE)
{
	$jsonObj .= "\"result\":true";
}
else
	$jsonObj .= "\"result\":false";
$jsonObj .= "}";
echo $jsonObj;
$connection->close();
?>