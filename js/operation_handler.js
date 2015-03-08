function addRoom()
{
	add_room($("#room_name").val(),$("#room_telecom_no").val());
}

function addDept()
{
	add_dept($("#dept_name").val());
}

function addDesignation()
{
	add_designation($("#desig_name").val());
}

function add_room(name, telecom_no)
{
	var url = "controller/add_room.php?room_name="+name+"&room_telecom_no="+telecom_no;
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(obj.result)
			alert("Added");
		else
			alert(obj.reason);
	});
}

function get_dept(success,failed)
{
	var url = "controller/get_dept_info.php";
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(obj.length)
			success(obj);
		else
			failed();
	});
}

function delete_dept(id,success,failed)
{
	var url = "controller/delete_dept_info.php?dept_id="+id;
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(obj.result === "true")
			success();
		else
			failed();
	});
}


	
/** Fetches rooms from webservice and invokes callbacks accordingly.*/
function get_room(successCallback,failedCallback)
{
	var url = "controller/get_room_info.php";
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(obj.length > 0)
			successCallback(obj);
		else
			failedCallback(obj);
	});
}

function add_dept(name)
{
	var url = "controller/add_dept.php?dept_name="+name;
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(obj.result)
			alert("Added");
		else
			alert(obj.reason);
	});
}

function delete_room(id,success,failled)
{
	var url = "controller/delete_room_info.php?room_id="+id;
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(obj.result === "true")
			success();
		else
			failled();
	});
}


function add_designation(name)
{
	var url = "controller/add_designation.php?desig_name="+name;
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(obj.result)
			alert("Added");
		else
			alert(obj.reason);
	});
}

function fill_dropdown(dataObj,element_id)
{
	var len = dataObj.length;
	var element = document.getElementById(element_id);
	$(element).empty();
	var option = document.createElement("option");
		option.text = "Select";
		element.add(option);
	for (var i =0 ; i < len; i++)
	{
		option = document.createElement("option");
		option.text = dataObj[i].name;
		option.value = dataObj[i].id;
		element.add(option);
	}
}

function fill_dropdown_with_array(dataObj,element_id)
{
	var len = dataObj.length;
	var element = document.getElementById(element_id);
	$(element).empty();
	var option = document.createElement("option");
		option.text = "Select";
		element.add(option);
	for (var i =0 ; i < len; i++)
	{
		option = document.createElement("option");
		option.text = dataObj[i];
		option.value = dataObj[i];
		element.add(option);
	}
}

function fill_dropdown_desig(dataObj,element_id)
{
	var len = dataObj.length;
	var element = document.getElementById(element_id);
	$(element).empty();
	var option = document.createElement("option");
		option.text = "Select";
		element.add(option);
	for (var i =0 ; i < len; i++)
	{
		option = document.createElement("option");
		option.text = dataObj[i].Designation;
		option.value = dataObj[i].Designation;
		element.add(option);
	}
}





function prepare_edit_employee()
{
	var container = document.getElementById("id_edit_employee");
	var url = "controller/get_emp_info.php";
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(obj.length)
		{
			fill_dropdown(obj,"select_emp_record");
			$("#select_emp_record").change(function(){
				prepare_edit_employee_window(obj,$(this).val());
			});
			container.style.display = "block";
		}	
		else
			alert("Network problem");
	});
}

function prepare_edit_employee_window(dataObj,value)
{
	document.getElementById("emp_name").value = dataObj[value].name;
	document.getElementById("emp_designation").value = dataObj[value].designation;
	document.getElementById("emp_department").value = dataObj[value].dept;
	
	
	var url = "controller/get_room_info.php";
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(obj.length)
		{
			fill_dropdown(obj,"emp_room");
			document.getElementById("emp_room").value = get_index(obj,dataObj[value].room);
			document.getElementById("id_edit_employee").style.display = "block";
		}
		else
		{
			alert("Network problem");
		}
	});

	document.getElementById("emp_id").value = dataObj[value].id;
}

function get_index(dataObj,value)
{
	alert(value);
	for(var i = 0;i<dataObj.length;i++)
	{
		alert(dataObj[i].name);
		if(dataObj[i].id == value)
			return i;
	}
}

function prepare_add_room()
{
	var container = document.getElementById("id_add_room");
	var url = "controller/get_room_info.php";
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		container.style.display = "block";
		
	});
}

function prepare_edit_room()
{
	var container = document.getElementById("id_add_room");
	var url = "controller/get_room_info.php";
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		container.style.display = "block";
		
	});
}

function prepare_add_department()
{
	var container = document.getElementById("id_add_dept");
	var url = "controller/get_dept_info.php";
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		container.style.display = "block";
		
	});
}



function update_place(room_id,emp_id)
{
	var url = "controller/update_place.php?emp_id="+emp_id+"&room_id="+room_id;
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(!obj.result)
			alert(obj.reason);
		
	});
}

function update_place(room_id,emp_id,callback)
{
	var url = "controller/update_place.php?emp_id="+emp_id+"&room_id="+room_id;
	$.get(url,function(data,status){
		var obj = JSON.parse(data);
		if(!obj.result)
			alert(obj.reason);
		else
			callback();
		
	});
}

function stringToBoolean(string){
	switch(string.toLowerCase()){
		case "true": case "yes": case "1": return true;
		case "false": case "no": case "0": case null: return false;
		default: return Boolean(string);
	}
}

