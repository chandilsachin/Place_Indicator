<?php 
$filter = $_GET["desig_name"];
include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
$command = "select * from designation";
if(	strcmp($filter, ""))
	$command .= " where designation like '".$filter."%'";

$jsonObj = "[";	
$result = $connection->query($command);
$len = $result->num_rows;
if($result->num_rows > 0)
{
	$rows = $result->fetch_assoc();
	$jsonObj .= "{\"Designation\":\"".$rows["designation"]."\"}";
	
	
	for($x = 1; $x < $len; $x++)
	{
		$rows = $result->fetch_assoc();
		$jsonObj .= ",{\"Designation\":\"".$rows["designation"]."\"}";
	}
}
$jsonObj .= "]";
echo $jsonObj;
$connection->close();
?>