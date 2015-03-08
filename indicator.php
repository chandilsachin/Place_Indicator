<html>
	<head>
		<title>Indicator</title>
		<meta charset="utf-8"> 
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/my_css.css"/>
		<script type="text/javascript" src="js/jquery-1.11.2.js"></script>
		<script type="text/javascript" src="js/operation_handler.js"></script>
	</head>
	<body>
		<div class="my-container">
			<div class="my-container-top-bar">Locations
				<div id="current_time" class="align-right">Time:</div>
			</div>
			<div class="my-content">
				<table id="list" class="my-table-style1">
					
				</table>
			</div>
		</div>
		<?php include "place_management.php"; ?>
	</body>
	<script type="text/javascript">
		function prepare_list()
		{
			setInterval(function(){update_time()},1000);
			var container = document.getElementById("list");
			var div;
			var url = "controller/get_emp_location.php";
			$.get(url,function(data,status){
				var obj = JSON.parse(data);
				if(obj.length)
				{
					$(container).empty();
					var tr = document.createElement("thead");
					var td = document.createElement("td");
					td.innerHTML = "Employee Name";
					tr.appendChild(td);
					
					td = document.createElement("td");
					td.innerHTML = "Email Id";
					tr.appendChild(td);

					td = document.createElement("td");
					td.innerHTML = "Usual Place";

					tr.appendChild(td);

					td = document.createElement("td");
					td.innerHTML = "Current Room";

					tr.appendChild(td);

					td = document.createElement("td");
					td.innerHTML = "Extension";
					tr.appendChild(td);

					td = document.createElement("td");
					td.innerHTML = "From";
					tr.appendChild(td);
					container.appendChild(tr);

					for(var i=0;i<obj.length;i++)
					{
						tr = document.createElement("tr");

						if(stringToBoolean(obj[i].updated))
							tr.className = "updated-row";
						else
							tr.className = "";

						td = document.createElement("td");
						td.innerHTML = obj[i].name;
						tr.appendChild(td);
						
						td = document.createElement("td");
						td.innerHTML = obj[i].emailid.split("@")[0];
						tr.appendChild(td);

						td = document.createElement("td");
						td.innerHTML = obj[i].usual_place;
						tr.appendChild(td);

						td = document.createElement("td");
						td.innerHTML = obj[i].room_name;
						td.value = obj[i].id;
						td.className += "cursor-pointer";
						/*Click event of current room block */
						td.onclick = function(ev){
							
							show_place_grid(this.value,ev);
						};
						tr.appendChild(td);

						td = document.createElement("td");
						td.innerHTML = obj[i].telecom_no;
						tr.appendChild(td);

						td = document.createElement("td");
						td.innerHTML = format_time(obj[i].time);
						tr.appendChild(td);
						container.appendChild(tr);

					}
				}
			});
		}
		function show_place_grid(emp_id,ev)
		{
			prepare_place_window(emp_id);
			var listContainer = document.getElementById("id_place_window");
			listContainer.style.display = "block";
			if(ev.x+listContainer.offsetWidth > window.innerWidth)
				listContainer.style.left = ev.x-(ev.x+listContainer.offsetWidth-window.innerWidth);
			else
				listContainer.style.left = ev.x;
			listContainer.style.top = ev.target.getBoundingClientRect().bottom;
			listContainer.style.position = "absolute";
			
		}
		function format_time(time)
		{
			var timeStr = "";
			var arr = time.split(":");
			if(arr[0] > 12)
				timeStr = (arr[0] - 12)+":"+arr[1]+":"+arr[2]+" PM";
			if(arr[0] < 12)
				timeStr = arr[0] +":"+arr[1]+":"+arr[2]+" AM";
			return timeStr;
		}
		function update_time()
		{
			var date = new Date();
			document.getElementById("current_time").innerHTML = format_time(date.getHours()+":"+date.getMinutes()+":"+date.getSeconds());
		}
		prepare_list();	
	</script>
</html>