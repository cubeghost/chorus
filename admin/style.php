<?php header("Content-type: text/css"); 
$s = parse_ini_file("settings.ini");
?>

      
body {
	background:<?=$s[dark_color];?>;
	background:url(<?=$s[background];?>);
	font-family:Helvetica, Arial, sans-serif;
	font-size:16px;
	margin:auto auto;
	padding:0;
}
      
div.shell {
	background:rgba(0,0,0,0.2);
	margin: 0 auto; 
	padding:20px;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
	margin-top:5%;
	margin-bottom:1%;
	display:block;
}

#box {position:relative;width:500px;}

.inner {
	background:#fff;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	padding:20px;
	-webkit-box-shadow: rgba(0,0,0,0.3) 0px 0px 5px;
	-moz-box-shadow: rgba(0,0,0,0.3) 0px 0px 5px;
	box-shadow: rgba(0,0,0,0.3) 0px 0px 5px; 
	height:100%;
	font-family:Helvetica,sans-serif;
}

input {	
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	padding:3px 5px;
	border:3px #eee solid;
	margin-top:10px;
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
}

input:focus {outline:none;border:3px <?=$s[light_color];?> solid;}

input[type=submit] {background:#eee;border:3px #eee solid;padding:3px 5px;font-size:16px;margin-right:10px;} 
input[type=submit]:focus {background:<?=$s[light_color];?>;border:3px <?=$s[light_color];?> solid;}
input[type=submit]:hover {background:<?=$s[light_color];?>;border:3px <?=$s[light_color];?> solid!important;}

#adminwrap {padding:0px;}

#nav {
	background:#eee;
	-webkit-border-top-left-radius: 10px;
	-webkit-border-top-right-radius: 10px;
	-moz-border-radius-topleft: 10px;
	-moz-border-radius-topright: 10px;
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
	padding:20px;
}

#nav a {color:#333;margin:10px;font-weight:bold;text-decoration:none;border-bottom:<?=$s[light_color];?> 2px solid;display:inline;}
#nav a:first-child {margin-left:0px!important;}
#nav a:hover {color:#000;border-bottom-color:<?=$s[dark_color];?>}
#nav span {}



#admin {float:left;padding:20px;width:520px;}

textarea.edit {width:90%;height:170px;padding:10px;margin-bottom:20px;font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;-webkit-border-radius:8px;-moz-border-radius:8px;border-radius:8px;border:#eee solid 3px;}

textarea.edit:focus {outline:none;border:3px <?=$s[light_color];?> solid;}

#minibar {
	padding:5px; 
	background-color:#f5f5f5;
    background-color:#242424;
    display:none; 
	position:fixed; 
	top:0px; 
	left:0px; 
	overflow:hidden;
	border-radius:10px; 
	-moz-border-radius:10px;
	-webit-border-radius:10px; 
	box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
	-moz-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2); 
	-webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
	color:#fff;
}
#minibar:hover {}
#minibar a {text-decoration:none;color:#fff;padding:5px;}
#minibar a:hover {color:<?=$s[light_color];?>;}
