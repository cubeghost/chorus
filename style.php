<?php header("Content-type: text/css"); 
$s = parse_ini_file("./admin/settings.ini");
?>

@font-face {
  font-family: Socialico;
  src: url("Socialico.otf");
}
* {padding:0;margin:0;outline:none;}
body {font-weight: 100;background:#333;padding:0;margin:0;color:#eee;font-family:'Ubuntu',Helvetica Neue,Helvetica ,Arial,sans-serif;height:100%;overflow:auto;padding-bottom:80px;}

h2 {font-size:30px;font-weight:500;width:100%;}

h2 a {color:#eee;text-decoration:none;opacity:0.6;}

::selection {background:<?=$s[light_color];?>;}

#taco {margin-top:7%;margin-left:45%;width:50%;}

@-webkit-keyframes fingerbounce {
 from {
   margin-bottom: 10px;
   margin-top: 0px;
 }
 to {
   margin-bottom: 20px;
   margin-top: -10px;
 }
}

#finger {margin-left:257px;-webkit-animation:fingerbounce 1s infinite alternate ease-in-out;visibility: visible;opacity:1;}
/*#finger:hover {margin-top:-10px;margin-bottom:10px;}*/


.links a {width:66%;display:block;padding:15px;font-size:20px;background:#eee;margin:30px 20px 20px 5px;color: <?=$s[dark_color];?>;font-weight:500;border-radius:10px;border-top-left-radius:0px;border-right:20px solid #eee;}

.links a:hover {opacity:0.8;}

.external a {border-right:20px solid <?=$s[light_color];?>;}

::-webkit-scrollbar              {width:9px;height:9px;background: <?=$s[dark_color];?>;}
::-webkit-scrollbar-button       {}
::-webkit-scrollbar-corner       {background: <?=$s[dark_color];?>;}
::-webkit-resizer                {background: <?=$s[dark_color];?>;}
::-webkit-scrollbar-track        {}
::-webkit-scrollbar-track-piece  {}
::-webkit-scrollbar-thumb        {background:#eee;border-radius:20px;border:1px solid <?=$s[dark_color];?>;}
