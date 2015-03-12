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
	var empid_roomid_mapping = [];
		function prepare_list()
		{
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
					td.innerHTML = "Current Extension";
					tr.appendChild(td);

					td = document.createElement("td");
					td.innerHTML = "Since";
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
						td.innerHTML = obj[i].usual_place+" ("+obj[i].telecom_no+")";
						tr.appendChild(td);

						td = document.createElement("td");
						td.innerHTML = obj[i].room_name;
						td.value = obj[i].id;
						empid_roomid_mapping[obj[i].id] = obj[i].room_name;
						td.className += "cursor-pointer";
						/*Click event of current room block */
						td.onclick = function(ev){
							show_place_grid(this.value,ev,empid_roomid_mapping[this.value]);
						};
						tr.appendChild(td);

						td = document.createElement("td");
						td.innerHTML = obj[i].updated_telecom_no;
						tr.appendChild(td);

						td = document.createElement("td");
						td.innerHTML = format_readable_time(calculate_time_diff(obj[i].time, obj[i].time));
						tr.appendChild(td);
						container.appendChild(tr);

					}
				}
			});
		}
		function show_place_grid(emp_id,ev,room_name)
		{
			prepare_place_window(emp_id,room_name);
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
		function calculate_time_diff(time1)
		{
			var currentDate = new Date();
			var time = time1.split(":");
			var date1 = new Date(currentDate.getFullYear(),currentDate.getMonth(),currentDate.getDate(),time[0],time[1],time[2],0);
			return parseInt(currentDate - date1);
		}
		function format_readable_time(miliseconds)
		{
			var mins = parseInt(miliseconds / 60000);
			var hrs = parseInt(mins / 60);
			mins = mins % 60;
			var str = "";
			if(hrs > 1)
				str = hrs+" hrs";
			else if(hrs == 1)
				str = hrs+" hr";
			if(mins > 1)
				str += mins+" mins";
			else if(mins <= 1)
				str += mins+" min";
			return str;
		}
		setInterval(function(){update_time()},1000);
		setInterval(function(){prepare_list()},1000*60);
		prepare_list();	
	</script>
</html>