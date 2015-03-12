<?php 
include 'initdata.php';

$connection = new mysqli($host,$username,$password,$database);

$command = "select e.id,e.name as emp_name,e.emailid,(select name from room where id = e.room) as room,(select name from room where id = room_id) as updated_room,(select telecom_no from room where id = e.room) as usual_telecom,(select telecom_no from room where id = room_id) as telecom_no,time_of_entry,case when room = room_id then 'false' else 'true' end updated from employee e,room r,current_place where emp_id=e.id and r.id=e.room";

$jsonObj = "[";	
$result = $connection->query($command);

$len = $result->num_rows;
if($result->num_rows > 0)
{
	$rows = $result->fetch_assoc();
	$jsonObj .= "{";
	$jsonObj .= "\"id\":\"".$rows["id"]."\",";
	$jsonObj .= "\"name\":\"".$rows["emp_name"]."\",";
	$jsonObj .= "\"emailid\":\"".$rows["emailid"]."\",";
	$jsonObj .= "\"usual_place\":\"".$rows["room"]."\",";
	$jsonObj .= "\"room_name\":\"".$rows["updated_room"]."\",";
	$jsonObj .= "\"time\":\"".$rows["time_of_entry"]."\",";
	$jsonObj .= "\"updated_telecom_no\":\"".$rows["telecom_no"]."\",";
	$jsonObj .= "\"telecom_no\":\"".$rows["usual_telecom"]."\",";
	$jsonObj .= "\"updated\":\"".$rows["updated"]."\"";
	$jsonObj .= "}";
	
	for($x = 1; $x < $len; $x++)
	{
		$rows = $result->fetch_assoc();
		$jsonObj .= ",{";
		$jsonObj .= "\"id\":\"".$rows["id"]."\",";
		$jsonObj .= "\"name\":\"".$rows["emp_name"]."\",";
		$jsonObj .= "\"emailid\":\"".$rows["emailid"]."\",";
		$jsonObj .= "\"usual_place\":\"".$rows["room"]."\",";
		$jsonObj .= "\"room_name\":\"".$rows["updated_room"]."\",";
		$jsonObj .= "\"time\":\"".$rows["time_of_entry"]."\",";
		$jsonObj .= "\"updated_telecom_no\":\"".$rows["telecom_no"]."\",";
		$jsonObj .= "\"telecom_no\":\"".$rows["usual_telecom"]."\",";
		$jsonObj .= "\"updated\":\"".$rows["updated"]."\"";
		$jsonObj .= "}";
	}
}
$jsonObj .= "]";
echo $jsonObj;
$connection->close();
?>