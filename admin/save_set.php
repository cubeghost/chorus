<?php
$nl = chr(10);
	foreach ($_POST as $key => $value) {
		$data .= $key . " = " . $value . $nl;
	}
	$data = str_replace('type = '.$nl, '', $data);
	$fh = fopen('settings.ini', 'w') or die("Can't open file");
	fwrite($fh, $data);
	fclose($fh);

	if ($fh) return 1;  
		else return 0;
?>