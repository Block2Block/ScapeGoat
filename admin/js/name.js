Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}

function startEdit(id) {
	var name = document.getElementById(id + "-name").innerHTML;
	document.getElementById(id + "-name").innerHTML = "";
	
	document.getElementById(id + "-name").innerHTML = "<input class='form-control mr-sm-2' type='text' placeholder='" + name + "' id='" + id + "-newname'>";
	document.getElementById(id + "-edit").setAttribute("onclick", "editName(" + id + ")");
	document.getElementById(id + "-delete").innerHTML = "<i class='fas fa-times'></i> Cancel";
	document.getElementById(id + "-delete").setAttribute("onclick", "cancelName(" + id + ")");
}

function editName(id) {
			var newname = document.getElementById(id + "-newname").value;
			if (newname == ""|| newname == null) {
				alert("You must specify a value.");
				return;
			}
          $.ajax({
            url:"../generator/functions.php", //the page containing php script
            type: "post", //request type,
           data: "editid=" + id + "&editname=" + newname,
            success:function(result){
			document.getElementById(id + "-name").innerHTML = newname;
			document.getElementById(id + "-edit").setAttribute("onclick", "startEdit(" + id + ")");
			
			document.getElementById(id + "-delete").innerHTML = "<i class='fas fa-trash-alt'></i> Delete";
		document.getElementById(id + "-delete").setAttribute("onclick", "deleteName(" + id + ")");
           }
         });
     }
	 
	 function cancelName(id) {
		document.getElementById(id + "-delete").innerHTML = "<i class='fas fa-trash-alt'></i> Delete";
		document.getElementById(id + "-delete").setAttribute("onclick", "deleteName(" + id + ")");
		
		document.getElementById(id + "-name").innerHTML = document.getElementById(id + "-newname").getAttribute("placeholder");
		document.getElementById(id + "-edit").setAttribute("onclick", "startEdit(" + id + ")");
		
	 }

function deleteName(id) {
	$.ajax({
            url:"../generator/functions.php", //the page containing php script
            type: "post", //request type,
           data: "deleteid=" + id,
            success:function(result){
			document.getElementById(id).remove();
           }
         });
}

function newclassmate() {
	var elementExists = document.getElementById("new");
	if (elementExists != null) {
		return;
	}
	document.getElementById("table-values").innerHTML += "<tr id='new'><td id='new-id'>-</td><td id='new-name-table'><input class='form-control mr-sm-2' type='text' placeholder='John Doe' id='new-name'></td><td><button type'button' class='btn btn-success' id='new-save' onclick='saveNew()'><i class='fas fa-save'></i> Save</button> <button type='button' class='btn btn-danger' id='new-cancel' onclick='newCancel()'><i class='fas fa-times'></i> Cancel</button></td></tr>"
}

function saveNew() {
	if (document.getElementById("new-name").value == ""||document.getElementById("new-name").value == null) {
		return;
	}
	var newname = document.getElementById("new-name").value
	$.ajax({
            url:"../generator/functions.php", //the page containing php script
            type: "post", //request type,
           data: "newname=" + newname,
            success:function(result){
			document.getElementById("new-id").innerHTML = result;
			document.getElementById("new-id").setAttribute("id", result + "-id");
			
			document.getElementById("new-name-table").innerHTML = document.getElementById("new-name").value;
			document.getElementById("new-name-table").setAttribute("id",result + "-name");
			
			document.getElementById("new-save").setAttribute("class", "btn btn-secondary");
			document.getElementById("new-save").innerHTML = "<i class='fas fa-pencil-alt'></i> Edit Name";
			document.getElementById("new-save").setAttribute("onclick", "startEdit(" + result + ")");
			document.getElementById("new-save").setAttribute("id", result + "-edit");
			
			document.getElementById("new-cancel").innerHTML = "<i class='fas fa-trash-alt'></i> Delete";
			document.getElementById("new-cancel").setAttribute("onclick", "deleteName(" + result + ")");
			document.getElementById("new-cancel").setAttribute("id", result + "-delete");
			
			document.getElementById("new").setAttribute("id", result);
			
           }
         });
}

function newCancel() {
	document.getElementById("new").remove();
}

function resetclass() {
	if (confirm("Are you sure you want to reset the class?\nThis will reset all classmates and reset Auto-IDs back to 1. It will\nalso reset ScapeGoat history.")) {
		$.ajax({
            url:"../generator/functions.php", //the page containing php script
            type: "post", //request type,
           data: "reset=true",
            success:function(result){
			document.getElementById("table-values").innerHTML = "";
			alert(result);
           }
         });
	} else {
		return;
	}
}