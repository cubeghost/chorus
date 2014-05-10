<?php 
$texts = scandir('txt/');
foreach($texts as $text) {
    if (is_file('txt/'.$text) == true) {
        $txt_content = file_get_contents('txt/'.$text);
        $txt[$text] = $txt_content;
    }
}

$s = parse_ini_file("admin/settings.ini");
?>
<!DOCTYPE html>
<!-- running on CHORUS : http://chorus.goose.im/ -->
<html>
<head>
	<title><?=$s['title'];?></title>
	<link href="http://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=PT+Sans:400italic,400,700italic,700" rel="stylesheet" type="text/css">
  	<style type="text/css">
    	* {box-sizing:border-box;padding:0;margin:0;outline:0;}
      	body {background:#333 url(http://s.goose.im/16-17.png);color:#fff;font-family:'PT Sans',sans-serif;}
      	.alpha {width:800px;margin:10% auto;background:rgba(0,0,0,0.75);padding:5%;}
      	h1 {font-family:'Abril Fatface';font-size:4em;font-weight:400;}
      	a {color:#eee;text-decoration:none;}
      	a:hover {color:<?=$s['color'];?>;}
 	</style>