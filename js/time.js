function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  var a = "AM";
  if (h >= 12) {
	a = "PM";
	if (h > 12) {
		h = h - 12;
	}	
  } else if (h == 0 && m == 0 && s == 15) {
	$.ajax({
            url:"/generator/functions.php", //the page containing php script
            type: "post", //request type,
           data: "getcurrent=true",
            success:function(result){
			document.getElementById("name").innerHTML = result;
			document.getElementById("name").removeAttribute("class");
			
			document.getElementById("name").style.visibility = "hidden";
			setTimeout(function(){ document.getElementById("name").setAttribute("class", "w3-jumbo w3-animate-top"); document.getElementById("name").style.visibility = "visible";}, 500);
			
			console.log(result);
           }
  });
  }
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('txt').innerHTML =
  h + ":" + m + ":" + s + " " + a;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
