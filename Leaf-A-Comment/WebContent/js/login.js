window.onload = function()
{
	let params = new URLSearchParams(location.search);
	var err = params.get("err");	
	if (err != "")
	{
		document.getElementById("toast").hidden = false;
		document.getElementById("toast").style.color = "red";
	}
};
