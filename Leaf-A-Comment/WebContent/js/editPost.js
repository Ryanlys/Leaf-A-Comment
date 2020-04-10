window.onload = function()
	{
		$("textarea").css("background-color","white");
		$("#delete").click(function(e)
		{
			e.preventDefault();
			var r = confirm("Are you sure you want to delete this post?");
			if (r)
			{
				let params = new URLSearchParams(location.search);
				var pid = params.get("pid");
				var pid = "deletePost.php?pid="+pid;
				window.location.href=pid;
			}
		});

		$("#cancelEdit").click(function()
		{
			var r = confirm("Are you sure you want to discard edit?");
			if (r)
			{
				let params = new URLSearchParams(location.search);
				var pid = params.get("pid");
				var pid = "viewPost.php?pid="+pid;
				window.location.href=pid;
			}
		});

		let params = new URLSearchParams(location.search);
		let pid = params.get("pid");
		let text = "<input type=\"hidden\" name=\"pid\" value=\""+pid+"\">";
		$("form > fieldset").after(text);
	};