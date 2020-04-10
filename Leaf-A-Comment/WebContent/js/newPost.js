window.onload = function()
{
	$("#123").click(function()
	{
		var r = confirm("Are you sure you want to discard the post?");
		if (r)
		{
			var main = "main.php";
			window.location.href=main;
		}
	});	
};