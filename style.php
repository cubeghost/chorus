<?php header("Content-type: text/css"); 
$s = parse_ini_file("./admin/settings.ini");
?>

@import url(http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300);

* {padding:0;margin:0;outline:none;}
body {font-family:'Open Sans',sans-serif;background:<?=$s[dark_color];?> url(<?=$s[background];?>);}

h2 {font-size:30px;font-weight:300;width:100%;}

h2 a {color:#eee;text-decoration:none;opacity:0.6;}

::selection {background:<?=$s[light_color];?>;}

.alpha {width:70%;margin:100px auto;}

::-webkit-scrollbar              {width:9px;height:9px;background: <?=$s[dark_color];?>;}
::-webkit-scrollbar-button       {}
::-webkit-scrollbar-corner       {background: <?=$s[dark_color];?>;}
::-webkit-resizer                {background: <?=$s[dark_color];?>;}
::-webkit-scrollbar-track        {}
::-webkit-scrollbar-track-piece  {}
::-webkit-scrollbar-thumb        {background:#eee;border-radius:20px;border:1px solid <?=$s[dark_color];?>;}
