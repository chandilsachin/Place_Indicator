<?php 
$filter = $_GET["room_name"];
include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
$command = "select * from room";
if(	strcmp($filter, ""))
	$command .= " where name like '".$filter."%'";
$command .= " order by name";
$jsonObj = "[";	
$result = $connection->query($command);
$len = $result->num_rows;
if($result->num_rows > 0)
{
	$rows = $result->fetch_assoc();
	$jsonObj .= "{";
	$jsonObj .= "\"id\":\"".$rows["id"]."\",";
	$jsonObj .= "\"name\":\"".$rows["name"]."\",";
	$jsonObj .= "\"telecom_no\":\"".$rows["telecom_no"]."\"";
	$jsonObj .= "}";
	
	for($x = 1; $x < $len; $x++)
	{
		$rows = $result->fetch_assoc();
		$jsonObj .= ",{";
		$jsonObj .= "\"id\":\"".$rows["id"]."\",";
		$jsonObj .= "\"name\":\"".$rows["name"]."\",";
		$jsonObj .= "\"telecom_no\":\"".$rows["telecom_no"]."\"";
		$jsonObj .= "}";
	}
}
$jsonObj .= "]";
echo $jsonObj;
$connection->close();
?>