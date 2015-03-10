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
				alert("No Room is listed in Database.");
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
				alert("No Designation is listed in Database.");
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
				alert("No Department is listed in Database.");
		});
	}
</script>

<div class="window my-container" id="id_edit_employee">
	<div class="my-container-top-bar">Edit Employee</div>

	<div class="list" id="empList"></div>
</div>
<script type="text/javascript">
	function prepare_edit_employee()
	{
		var container = $("#id_edit_employee");
		get_employee(function(obj){

			var list = $("#empList");
			list.empty();
			var table = $("<table class='my-table-style1'>");
			var tr = $("<thead>");
			var td = $("<td>");
			td.html("Name");
			tr.append(td);

			td = $("<td>");
			td.html("Designation");
			tr.append(td);

			td = $("<td>");
			td.html("Department");
			tr.append(td);

			td = $("<td>");
			td.html("Email Id");
			tr.append(td);

			td = $("<td>");
			td.html("Room");
			tr.append(td);

			td = $("<td>");
			tr.append(td);
			table.append(tr);
			for(var i=0;i<obj.length;i++)
			{
				var tr = $("<tr>");
				var td = $("<td>");
				td.html(obj[i].name);
				tr.append(td);

				td = $("<td>");
				td.html(obj[i].designation);
				tr.append(td);

				td = $("<td>");
				td.html(obj[i].dept);
				tr.append(td);

				td = $("<td>");
				td.html(obj[i].emailid);
				tr.append(td);

				td = $("<td>");
				td.html(obj[i].room);
				tr.append(td);

				td = $("<td>");
				var hiddenInput = $("<input type='hidden'>");
				hiddenInput.val(obj[i].id);
				td.append(hiddenInput);
				var link = $("<a class='link' href='#'>Delete</a>");
				link.click(function(){
					var row = $(this).parent().parent();
					 delete_employee($(this).prev().val(), 
						function(obj){
							row.detach();
						},
						function(obj){
							alert(obj.reason);
						});
				});
				td.append(link);
				tr.append(td);
				table.append(tr);
			}
			list.append(table);
			container.show();
		}, function(obj){
				if(!obj.length)
					alert("No Employee is listed in Database.");
				else
					alert(obj.reason);
			});
	}

</script>