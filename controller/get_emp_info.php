<?php 
$filter = $_GET["emp_name"];
include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);
$command = "select * from employee";
if(	strcmp($filter, ""))
	$command .= " where name like '".$filter."%'";

$jsonObj = "[";	
$result = $connection->query($command);
$len = $result->num_rows;
if($result->num_rows > 0)
{
	$rows = $result->fetch_assoc();
	$jsonObj .= "{";
	$jsonObj .= "\"id\":\"".$rows["id"]."\",";
	$jsonObj .= "\"name\":\"".$rows["name"]."\",";
	$jsonObj .= "\"designation\":\"".$rows["designation"]."\",";
	$jsonObj .= "\"dept\":\"".$rows["dept"]."\",";
	$jsonObj .= "\"emailid\":\"".$rows["emailid"]."\",";
	$jsonObj .= "\"room\":\"".$rows["room"]."\"";
	$jsonObj .= "}";
	
	for($x = 1; $x < $len; $x++)
	{
		$rows = $result->fetch_assoc();
		$jsonObj .= ",{";
		$jsonObj .= "\"id\":\"".$rows["id"]."\",";
		$jsonObj .= "\"name\":\"".$rows["name"]."\",";
		$jsonObj .= "\"designation\":\"".$rows["designation"]."\",";
		$jsonObj .= "\"dept\":\"".$rows["dept"]."\",";
		$jsonObj .= "\"emailid\":\"".$rows["emailid"]."\",";
		$jsonObj .= "\"room\":\"".$rows["room"]."\"";
		$jsonObj .= "}";
	}
}
$jsonObj .= "]";
echo $jsonObj;
$connection->close();
?>