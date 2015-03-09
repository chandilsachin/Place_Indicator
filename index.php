
<!DOCTYPE html>
<html>
	<head>
		<title>Indicator</title>
		<meta charset="utf-8"> 
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/my_css.css"/>
		<script type="text/javascript" src="js/jquery-1.11.2.js"></script>
		<script type="text/javascript" src="js/operation_handler.js"></script>
		<script type="text/javascript" src="js/my-util.js"></script>
		<script type="text/javascript">
		
		function reset()
		{
			$(".window").hide();
		}
		</script>
	</head>
	<body>
	<div class="container-fluid"></div>
		<table >
			<tr valign="top">
				<td>
					<ul>
						<li >
							<a href="#" onclick="reset();prepare_add_room()">Add room</a>
						</li>
						<li>
							<a href="#" onclick="reset();prepare_edit_room();">Edit room info</a>
						</li>
						<li>
							<a href="#" onclick="reset();prepare_add_employee()">Add employee</a>
						</li>
						<li>
							<a href="#" onclick="reset();prepare_edit_employee()">Edit employee info</a>
						</li>
						<li>
							<a href="#" onclick="reset();prepare_add_department()">Add department</a>
						</li>
						<li>
							<a href="#" onclick="reset();prepare_edit_dept();">Edit department info</a>
						</li>
						<li>
							<a href="#" onclick="reset();prepare_add_designation()">Add Designation</a>
						</li>
						<li>
							<a href="#" onclick="reset();prepare_edit_designation()" >Edit designation info</a>
						</li>
					</ul>
				</td>
				<td>
					<?php include 'add_room_module.php'; ?>
					<?php include 'add_employee_module.php'; ?>
					<?php include 'add_dept_module.php'; ?>
					<?php include 'add_designation_module.php'; ?>
					<?php include 'place_management.php'; ?>
				</td>
			</tr>
		</table>
		
	</body>
	<script>
		reset();
	</script>
</html>