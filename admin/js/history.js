function fetchnames() {
	var foundlast = false;
	
	for (var i=1; foundlast==false; i++) {
		if (document.getElementById(i) == null) {
			foundlast = true;
			return;
		}
		var id = document.getElementById(i).getAttribute("name");
		$.ajax({
            url:"../generator/functions.php", //the page containing php script
            type: "post", //request type,
           data: "getname=" + id + "&element=" + i.toString(),
            success:function(result){
			var x = result.split(" ")
			document.getElementById(parseInt(x[0])).innerHTML = x[1];
			document.getElementById(parseInt(x[0])).setAttribute("name", "name-set");
           }
         });
	}
}

function force(person, date) {
	console.log(person);
	console.log(date);
	if (date == "" || person == "") {
		document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade show'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Please ensure you select values when forcing a ScapeGoat!</div>";
		return;
	}
	
    $.ajax({
           url:"../generator/functions.php", //the page containing php script
           type: "post", //request type,
           data: "forcename=" + person + "&forcedate=" + date,
           success:function(result){
           document.getElementById("alerts").innerHTML = "<div class='alert alert-success alert-dismissible fade show'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> " + person + " has been successfully forced ScapeGoat until " + date + result + "!</div>";
           }
           });
	
}

function resetHistory() {
    $.ajax({
           url:"../generator/functions.php", //the page containing php script
           type: "post", //request type,
           data: "resethistory=true",
           success:function(result){
           document.getElementById("table-values").innerHTML = "";
           }
           });
}
