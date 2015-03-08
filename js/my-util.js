function utils()
{
	this.create_list = function(object){
		var str = "<ol>";
		for(var i;i<object.length;i++)
		{
			str = "<li></li>";
		}
		str += "</ol>";
		
	};
}
