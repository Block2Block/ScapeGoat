<!DOCTYPE html>
<html>
<title>ScapeGoat Generator</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="js/time.js"></script>
<style>
body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
    background-image: url('/img/astro-astronomy-background-956999.jpg');
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
</style>
<body onload="startTime()">

<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
<div class="w3-display-topleft w3-padding-large w3-xlarge">
And today's ScapeGoat is...
</div>
<div class="w3-display-middle">
<h1 class="w3-jumbo w3-animate-top" style="text-align:center;" id="name"><?php
    include_once "generator/functions.php";
    include_once "generator/db-connect.php";
    
    echo get_current_name($mysqli);
    ?></h1>
<hr class="w3-border-grey" style="margin:auto;width:40%">
<p class="w3-large w3-center"><?php
    echo date("l j");
    switch (date("j")) {
        case 1:
            echo "st";
            break;
        case 2:
            echo "nd";
            break;
        case 3:
            echo "rd";
            break;
        default:
            echo "th";
            break;
    }
    echo date(" F Y");
    echo " - <a id='txt'></a>";
    ?></p>
</div>
<div class="w3-display-bottomleft w3-padding-large">
Powered by Richard Power - A mystical power which allows ScapeGoats<a href="/admin">.</a>
</div>
</div>

</body>
</html>
