<div class="window my-container form" id="id_add_room">
	<div class="my-container-top-bar">Add Room</div>
	<table>
		<head>
			<th colspan="2"></th>
		</head>
		<tbody>
			<tr>
				<td>
					<span>Room Name:</span>
				</td>
				<td>
					<input type="text" id="room_name"/>
				</td>
			</tr>
			<tr>
				<td>
					<span>Room Telecom no:</span>
				</td>
				<td>
					<input type="number" id="room_telecom_no"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button class="btn_submit" onclick="addRoom()">Add</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="window my-container" id="id_edit_room">
	<div class="my-container-top-bar">Edit Room</div>
	
	<div id="roomlist" class="list">
		
	</div>
</div>
<script>
	function prepare_edit_room()
	{
		get_room(function(obj){
			
			var list = $("#roomlist");
			list.empty();
			var table = $("<table class='my-table-style1'>");
			var tr = $("<thead>");
			
			var td = $("<td>");
			td.html("Room Name");
			tr.append(td);
			
			td = $("<td>");
			td.html("Telecom no.");
			tr.append(td);

			td = $("<td>");
			tr.append(td);
			table.append(tr);
			for(var i=0;i<obj.length;i++)
			{
				var id = obj[i].id;
				tr = $("<tr>");
				tr.attr("id",id);
				td = $("<td>");
				td.html(obj[i].name);
				tr.append(td);
				
				td = $("<td>");
				td.html(obj[i].telecom_no);
				tr.append(td);

				td = $("<td>");
				var link = $("<a class='link' href='#'>");
				link.html("Delete");
				
				var hidden = $("<input type='hidden'>");
				hidden.val(id);
				link.click(function(){
					/* $("#"+$(this).prev().val()).detach(); */
					var container = $("#"+$(this).prev().val());
					delete_room($(this).prev().val(),function(){container.detach();},
							function(){alert("Error");} ); 
				});
				td.append(hidden);
				td.append(link);
				tr.append(td);
				table.append(tr);
					
			}
			list.append(table);
			$("#id_edit_room").show();
		},function(obj){
			if(!obj.length)
				alert("No Room is listed in Database.");
			else
				alert(obj.reason);
		});
	}
	
	
	
</script>