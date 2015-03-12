<div class="my-container" id="id_place_window">
	<div class="my-container-top-bar">Pick the place: <div class="my-close-btn" id="id-close-place-window"></div></div>
	<div class="my-content">
		<table align="center">
			<tr>
				<td id="A">
					
				</td>
			</tr>

			<tr>
				<td id="S">
					
				</td>
			</tr>
			
			<tr>
				<td id="U">
					
				</td>
			</tr>
			<tr>
				<td id="other">
					
				</td>
			</tr>
		</table>
	</div>
</div>
<script>
function prepare_place_window(emp_id,room_name)
{
	var container = document.getElementById("id_place_window");
	var url = "controller/get_room_info.php";
	var button;
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		var aContainer = document.getElementById("A");
		var sContainer = document.getElementById("S");
		var uContainer = document.getElementById("U");
		var other = document.getElementById("other");
		$(aContainer).empty();
		$(sContainer).empty();
		$(uContainer).empty();
		for(var i=0;i<obj.length;i++)
		{
			button = document.createElement("button");
			button.className = "my-button1 small";
			button.value = obj[i].id;
			button.innerHTML = obj[i].name;
			button.onclick = function(){
				var room_id = this.value;
				if(room_name != this.innerHTML)
				update_place(room_id,emp_id,prepare_list);
					
				document.getElementById("id_place_window").style.display = "none";
			};
			if(button.innerHTML.indexOf("A")==0)
				aContainer.appendChild(button);
			else if(button.innerHTML.indexOf("S")==0)
				sContainer.appendChild(button);
			else if(button.innerHTML.indexOf("U")==0)
				uContainer.appendChild(button);
			else
				other.appendChild(button);
		}
	});
	var window = document.getElementById("id-close-place-window");
	window.onclick = function(){
		document.getElementById("id_place_window").style.display = "none";
	};
}
</script>