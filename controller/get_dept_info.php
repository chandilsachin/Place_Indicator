<?php 
include 'initdata.php';
$filter = $_GET["dept_name"];


$connection = new mysqli($host,$username,$password,$database);
$command = "select * from department";
if(	strcmp($filter, ""))
	$command .= " where dept like '".$filter."%'";

$jsonObj = "[";	
$result = $connection->query($command);
$len = $result->num_rows;
if($result->num_rows > 0)
{
	$rows = $result->fetch_assoc();
	$jsonObj .= "\"".$rows["dept"]."\"";
	
	
	for($x = 1; $x < $len; $x++)
	{
		$rows = $result->fetch_assoc();
		$jsonObj .= ",\"".$rows["dept"]."\"";
	}
}
$jsonObj .= "]";
echo $jsonObj;
$connection->close();
?>