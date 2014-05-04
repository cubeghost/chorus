<?php
	$newcontent = $_POST['edit'];
	$newcontent = stripslashes($newcontent);
	$file = $_POST['file'];
	$dir = $_POST['dir'];

	$fh = fopen($dir.$file, 'w') or die("Can't open file");
	fwrite($fh, $newcontent);
	fclose($fh);

	if ($fh) return 1;  
		else return 0; 
?>