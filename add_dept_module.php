<div class="window my-container form" id="id_add_dept">
	<div class="my-container-top-bar">Add Department</div>
	<table>
		<thead>
			<th colspan="2">
				
			</th>
		</thead>
		<tbody>
			<tr>
				<td>
					<span>Name:</span>
				</td>
				<td>
					<input class="my-input" type="text" id="dept_name"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button class="my-button1" onclick="addDept()">Add</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="window" id="id_edit_dept">
	<div class="my-container-top-bar">Edit Department</div>
	
	<div class="list" id="deptlist">
	</div>		
</div>
<script>
	function prepare_edit_dept()
	{
		get_dept(
			function(obj){
				var list = $("#deptlist");
				list.empty();
				var table = $("<table class='my-table-style1'>");
				var tr = $("<thead>");
				var td = $("<td>");
				td.html("Department");
				tr.append(td);
				
				td = $("<td>");
				tr.append(td);
				table.append(tr);
				
				for(var i = 0;i<obj.length;i++)
				{
					var tr = $("<tr>");
					var td = $("<td>");
					td.html(obj[i]);
					tr.append(td);
					
					td = $("<td>");
					var link = $("<a href='#' class='link'>Delete</a>");
					link.click(function(){
						delete_dept($(this).parent().prev().html(),function(){
							$(this).parent().parent().detach();
							},function(){alert("Error")});
					});
					td.append(link);
					tr.append(td);
					table.append(tr);
				}
				list.append(table);
				$("#id_edit_dept").show();
			},
			 function(){

			}
		);
	}
	
</script>