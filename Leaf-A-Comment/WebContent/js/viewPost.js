window.onload = function()
{

	$("#mainReply").click(function()
	{
		$(".editComment").each(function(){$(this).attr("disabled",true)});
		$("#mainReply").attr("disabled",true);
		$(".replyButton").each(function(){$(this).attr("disabled",true)});

		let params = new URLSearchParams(location.search);
		let pid = params.get("pid");

		let text1 = "<form method=\"POST\" action=\"addComment.php\" id=\"mainForm\"><fieldset><label>Comment</label><br><textarea rows=\"5\" cols=\"50\" name=\"desc\" id=\"tarea\"></textarea><input type=\"hidden\" name=\"parent\" value=\"0\"/><input type=\"hidden\" name=\"pid\" value=\""+pid+"\"></fieldset><br><button type=\"submit\" id=\"mainSubmit\">Submit</button><button type=\"button\" id=\"cancelReply\">Cancel</button></form>";

		$(this).after(text1);
		$("#tarea").css("background-color","white");
		$("#cancelReply").click(function()
		{
			$("#mainReply").attr("disabled",false);
			$(".replyButton").each(function(){$(this).attr("disabled",false)});
			$(".editComment").each(function(){$(this).attr("disabled",false)});
			$("#mainForm").remove();
			$("#submitReply").remove();
			$(this).remove();
		});
	});

	$(".replyButton").click(function()
	{
		let params = new URLSearchParams(location.search);
		let pid = params.get("pid");

		$("#mainReply").attr("disabled",true);
		$(".replyButton").each(function(){$(this).attr("disabled",true)});
		$(".editComment").each(function(){$(this).attr("disabled",true)});
		let text1 = "<form method=\"post\" action=\"addComment.php\" id=\"replyForm\">\
		<fieldset><label>Comment</label><br><textarea rows=\"5\" cols=\"50\" name=\"desc\" id=\"tarea\">\
		</textarea><input type=\"hidden\" name=\"parent\" value=\""+$(this).parent().attr("id")+"\"><input type=\"hidden\" name=\"parent\" value=\""+pid+"\"></fieldset>\
		<br><button type=\"submit\" id=\"submitReply\">Submit</button><button type=\"button\" id=\"cancelReply\">Cancel</button></form>";
		$(this).after(text1);
		$("#tarea").css("background-color","white");
		$("#cancelReply").click(function()
		{
			$("#mainReply").attr("disabled",false);
			$(".replyButton").each(function(){$(this).attr("disabled",false)});
			$(".editComment").each(function(){$(this).attr("disabled",false)});
			$("#replyForm").remove();
			$("#submitReply").remove();
			$(this).remove();
		});
	});

	$(".editComment").click(function()
	{
		let params = new URLSearchParams(location.search);
		let pid = params.get("pid");

		$("#mainReply").attr("disabled",true);
		$(".editComment").each(function(){$(this).attr("disabled",true)});
		$(".replyButton").each(function(){$(this).attr("disabled",true)});
		let text1 = "<form method=\"post\" action=\"editComment.php\" id=\"replyForm\"><fieldset><label>Comment</label>\
		<br><textarea rows=\"5\" cols=\"50\" name=\"desc\" id=\"tarea\">"+$(this).parent().find(".comment").html()+"</textarea><input type=\"hidden\" name=\"cid\" value=\""+$(this).parent().attr("id")+"\">\
		<input type=\"hidden\" name=\"pid\" value=\""+pid+"\"></fieldset><br><button type=\"submit\" id=\"submitReply\">Submit</button><button type=\"button\" id=\"cancelReply\">Cancel</button></form>";
		
		$(this).after(text1);
		$("#tarea").css("background-color","white");
		$("#cancelReply").click(function()
		{
			$("#mainReply").attr("disabled",false);
			$(".replyButton").each(function(){$(this).attr("disabled",false)});
			$(".editComment").each(function(){$(this).attr("disabled",false)});
			$("#replyForm").remove();
			$("#submitReply").remove();
			$(this).remove();
		}); 
	});


	$(".divComment").each(function()
	{
		if($(this).attr("data-parent") != "0")
		{
			$(this).css("margin-left",parseInt(($(this).attr("data-depth")))*10);
			var parent = $(this).attr("data-parent");
			var parent = "#"+parent;
			$(this).appendTo($(parent));
		}
	});


};