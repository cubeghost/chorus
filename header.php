<?php
if ($handle = opendir('./data/')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
			$fileContent = file_get_contents('./data/' . $file);
            $content[$file] = $fileContent;
        }
    }
    closedir($handle);
}

$s = parse_ini_file("./admin/settings.ini");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<title><?=$s[site_title];?></title>

<meta name="viewport" content="width=device-width,max-width:devide-width,min-width:device-width,user-scalable=no" />

<link rel="stylesheet" href="/style.php" type="text/css" charset="utf-8">

	<script type="text/javascript" src="/jquery.min.js"></script> 

	<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<link rel="stylesheet" href="/fancybox/jquery.fancybox.css?v=2.1.2" type="text/css" media="screen" />
	<script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js?v=2.1.2"></script>

	<script type="text/javascript" src="/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="/fancybox/helpers/jquery.fancybox-media.js?v=1.0.4"></script>

	<script type="text/javascript" src="/jquery.backstretch.min.js"></script> 

	<script type="text/javascript">
	$(document).ready(function() {
	
		$('.fancylink').fancybox({
			padding:					0,
			closeBtn:					false,
			arrows:						false,
			minWidth:					'90%'
		});
		
		
		if(screen.width < 500 ||
			navigator.userAgent.match(/Android/i) ||
			navigator.userAgent.match(/webOS/i) ||
			navigator.userAgent.match(/iPhone/i) ||
			navigator.userAgent.match(/iPod/i) ) {
			
			$("#taco").css({'width':'100%','margin-left':'0%','font-size':'10em'});
			$(".links a").css({'width':'90%','border-right':'0'});
			$("h2").css({'margin':'10px'});
			$.backstretch("/<?=$s[background_mobile];?>");
						
		} else {
	   		
	  		$.backstretch("/<?=$s[background];?>");
		}
			
	});
	</script>

<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,500' rel='stylesheet' type='text/css'>

