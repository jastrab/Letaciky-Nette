function showResult(str) {
	console.log(str);
	if (str.length == 0) {
		document.getElementById("search").innerHTML="";
		document.getElementById("search").style.border="0px";
		document.getElementById("display").style.display="none";

		// document.getElementById("search2").innerHTML="";
		// document.getElementById("search2").style.border="0px";
		// document.getElementById("display2").style.display="none";
		return;
	}

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.open("POST","/search", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == XMLHttpRequest.DONE && this.status==200) {
			document.getElementById("display").innerHTML=this.responseText;
			document.getElementById("display").style.border="1px solid #A5ACB2";
			document.getElementById("display").style.display="block";

			// document.getElementById("display2").innerHTML=this.responseText;
			// document.getElementById("display2").style.border="1px solid #A5ACB2";
			// document.getElementById("display2").style.display="block";
		}
	}

	xmlhttp.send('query='+str);
}