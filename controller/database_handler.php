<?php 
	class DatabaseHandler
	{
		
		function __construct()
		{
			$connection = mysql_connect("localhost","root","");
		}

		function close()
		{
			mysql_close($connection);
		}

		function execute($command)
		{
			
		}
	}
?>