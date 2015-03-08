<div class="window my-container" id="id_add_employee">
	<div class="my-container-top-bar">Add Employee</div>
	<table>
		<thead>
			<th colspan="2">
				Add Employee
			</th>
		</thead>
		<tbody>
			<tr>
				<td>
					<span>Name:</span>
				</td>
				<td>
					<input type="hidden"  id="emp_id"/>
					<input type="text" id="emp_name"/>
				</td>
			</tr>
			<tr>
				<td>
					<span>Designation:</span>
				</td>
				<td>
					<select id="emp_designation"></select>
				</td>
			</tr>
			<tr>
				<td>
					<span>Department:</span>
				</td>
				<td>
					<select id="emp_department"></select>
				</td>
			</tr>
			<tr>
				<td>
					<span>Usual Place:</span>
				</td>
				<td>
					<select id="emp_room"></select>
				</td>
			</tr>
			<tr>
				<td>
					<span>Email Id:</span>
				</td>
				<td>
					<input type="email" id="emp_emailid"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button onclick="addEmployee()">Add</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script>
	function addEmployee()
	{
		alert($("#emp_room").val());
		add_employee($("#emp_name").val(),$("#emp_designation").val(),$("#emp_department").val(),$("#emp_room").val(),$("#emp_emailid").val());
	}

	function add_employee(name, designation,dept,room,email)
	{
		var url = "controller/add_employee.php?emp_name="+name+"&emp_designation="+designation+"&emp_dept="+dept+"&emp_room="+room+"&emp_emailid="+email;
		$.get(url,function(data,status){
			var obj = JSON.parse(data);
			if(obj.result)
				alert("Added");
			else
				alert(obj.reason);
		});
	}

	function prepare_add_employee()
	{
		var container = document.getElementById("id_add_employee");
		var url = "controller/get_room_info.php";
		$.get(url,function(data,status){
			var obj = JSON.parse(data);
			if(obj.length)
			{
				fill_dropdown(obj,"emp_room");
				container.style.display = "block";
			}	
			else
				alert("Network problem");
		});
		url = "controller/get_desig_info.php";
		$.get(url,function(data,status){
			var obj = JSON.parse(data);
			if(obj.length)
			{
				fill_dropdown_desig(obj,"emp_designation");
				container.style.display = "block";
			}	
			else
				alert("Network problem");
		});
		url = "controller/get_dept_info.php";
		$.get(url,function(data,status){
			var obj = JSON.parse(data);
			if(obj.length)
			{
				fill_dropdown_with_array(obj,"emp_department");
				container.style.display = "block";
			}	
			else
				alert("Network problem");
		});
	}
</script>