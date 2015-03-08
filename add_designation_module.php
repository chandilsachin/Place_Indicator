
<div class="window my-container form" id="id_add_designation">
	<div class="my-container-top-bar">Add Designation</div>
	<table>
		<thead>
			<th colspan="2">
				<span id="desig_title"></span>
			</th>
		</thead>
		<tbody>
			<tr>
				<td>
					<span>Designation:</span>
				</td>
				<td>
					<input type="text" id="desig_name"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button onclick="addDesignation()">Add</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div id="id_edit_designation" class="window my-container">
<div class="my-container-top-bar">Edit Designation</div>
	<div id="listDesig" class="listView">
		
	</div>
</div>

<script >
	function prepare_add_designation()
{
	var container = document.getElementById("id_add_designation");
	document.getElementById("desig_title").innerHtml = "Add Designation";
	var url = "controller/get_desig_info.php";
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		container.style.display = "block";
		
	});
}

function prepare_edit_designation()
{
	var container = document.getElementById("id_edit_designation");
	var url = "controller/get_desig_info.php";
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		$(document.getElementById("listDesig")).empty();
		document.getElementById("listDesig").appendChild(inflateListItem(obj));
		container.style.display = "block";
		
	});
}

function inflateListItem(dataObj)
{
	var table = document.createElement("table");
	table.style.width = "100%";
	var thead = document.createElement("thead");
	for(var key in dataObj[0])
	{
		var th = document.createElement("th");
		th.innerHTML = key;
		thead.appendChild(th);
		var th = document.createElement("th");
		thead.appendChild(th);
		var th = document.createElement("th");
		thead.appendChild(th);
		break;
	}

	table.appendChild(thead);
	for(var i=0;i<dataObj.length;i++)
	{
		var id;
		var tr = document.createElement("tr");
		for(var key in dataObj[i])
		{
			var td = document.createElement("td");
			var textBox = document.createElement("input");
			textBox.setAttribute('type','text');
			textBox.setAttribute('value',dataObj[i][key]);
			textBox.setAttribute('disabled','true');
			td.appendChild(textBox);
			id = dataObj[i][key];
			tr.appendChild(td);
		}
		tr.setAttribute('id',id);
		var td = document.createElement("td");

		var a = document.createElement("a");
		a.innerHTML = "Delete";
		a.onclick = function delete_desig()
		{
			var url = "controller/delete_desig_info.php?desig_name="+id;
			$.get(url,function(data,status){
				var obj = JSON.parse(data);
				if(obj.result)
					document.getElementById(id).remove();
				else
					alert("Can not remove");
			});
			
		};
		a.setAttribute('href',"#");
		td.appendChild(a);

		tr.appendChild(td);
		
		table.appendChild(tr);
	}
	return table;
}

</script>

