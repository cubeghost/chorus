<?php
session_start();
$login = '
<!DOCTYPE html>
<html>
  <head>
    <title>filedesk</title>
<link rel="stylesheet" href="style.php" type="text/css" charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="../jquery.backstretch.min.js"></script> 

<script>
$(document).ready(function() { 
	
	$.backstretch("../pbg.jpg");

	
	$("#adminwrap").hide();
	
	
	$("[name=login]").click(function() { 
	           //check the username exists or not from ajax
        $.post("login.php",{ username:$("[name=username]").val(),password:$("[name=password]").val(),rand:Math.random() } ,function(data) {
			if(data=="yes") {
				$("#box").animate({ 
					"margin-top": "10%"
				}, 300 );			
				$("#box").animate({ 
					"margin-top": "-100%"
				}, 600, 
				function() {
					document.location="index.php";
				});
			}
			else if(data="no") {
				$("#box").effect("shake", { times:3 }, 80);
				$("[name=username]").val("");
				$("[name=password]").val("");
			} else {}
       });
       return false;//not to post the  form physically

	  
	});
	

      
});

</script>
</head>
<body>
<center>
	<div class="shell" id="box">
		<div class="inner" id="loginform" style="text-align:left!important;">
			Hello. Care to log in before you get to work?
			<form id="login">
				<input type="text" name="username"><br>
				<input type="password" name="password"><br>
				<input type="submit" name="login" value="Log in" id="flogin"> 
			</form>
		</div>
	</div>	
</center>
</body>
</html>';

if(empty($_SESSION['admin'])) {
	echo $login;
}
else if(isset($_GET['logout'])) {
	session_destroy();
	echo $login;
} else {

if ($handle = opendir('../data/')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
			$fileContent = file_get_contents('../data/' . $file);
            $content[$file] = $fileContent;
			$filelist .= '<a href="?and='.$file.'" class="editlink">'.$file.'</a>';
        }
    }
    closedir($handle);
}

$settings = parse_ini_file("settings.ini");

foreach ($settings as $key => $value) {
	if (preg_match('/^#/', $value) && strlen($value) == 7) {
		$valuehex = trim($value, "#");
		if (ctype_xdigit($valuehex)) {
			$hexclass = ' class="color"';
		}
	}
	$settingsform .= '<label for="' . $key . '">' . $key . ' </label><input type="text" name="' . $key . '" value="' . $value . '"' . $hexclass . '><br>';
}

$settingsinfo = 'add content here to describe the settings';

$settingspage = 'settings<br><br>';
$settingspage .= $settingsinfo . '<br><br>';
$settingspage .= '<form class="ajaxform" action="" method="POST">';
$settingspage .= $settingsform;
$settingspage .= '<br><input type="submit" value="Save" class="fsubmit" id="save_set.php"><span id="status"></span></form>';



$uploadtarget = "../upload/" . basename( $_FILES['uploadedfile']['name']); 
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $uploadtarget)) {
    $uploadstatus = "The file <a href='../upload/" . basename( $_FILES['uploadedfile']['name']) . "' target='_blank'>" . basename( $_FILES['uploadedfile']['name']) . "</a> has been uploaded.";
		} else {
		$uploadstatus = "";
	}	
	
$adminpage = $_GET['and']; 

if (empty($adminpage)) {
	$pickedcontent = "This is the admin area. Please pick a content file to get started.";
	$enterscr = '
		$("#box").animate({ 
			"margin-top": "5%"
		}, 600, function() {		
			$("#box").animate({ 
				width: "700px"
			}, 600 );
			$("#admin").animate({ 
				width: "520px"
			}, 600 );
		});';
	$exstyle = '<style>	#box {margin-top:-100%;width:500px;} 
	#admin {width:320px;}</style>';
	
} elseif ($adminpage == 'settings'){
	$pickedcontent = $settingspage;
} elseif ($adminpage == 'upload'){
	$pickedcontent = 'upload to the gallery<br><br><form enctype="multipart/form-data" action="" method="POST">file: <input name="uploadedfile" type="file"><br><br><input type="submit" value="Upload"><span id="status">' . $uploadstatus . '</span></form><br><br>';
} else {
	$pickedcontent = 'editing '.$adminpage.'<br><br><form class="ajaxform" action="" method="POST"><input type="hidden" name="type" value"edit"><textarea id="edit" class="edit" name="edit">'.$content[$adminpage].'</textarea><input type="hidden" name="file" value="'.$adminpage.'"><br><input type="submit" value="Save" class="fsubmit" id="save.php"><span id="status"></span></form>';	
}	

echo '
<!DOCTYPE html>
<html>
  <head>
    <title>filedesk</title>
<link rel="stylesheet" href="style.php" type="text/css" charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
<style>#box {width:700px;}</style>';
echo $exstyle;
echo '
<script type="text/javascript" src="jquery.resize.min.js"></script>
<script type="text/javascript" src="jquery.caret.js"></script>
<script type="text/javascript" src="../jquery.backstretch.min.js"></script>
<script type="text/javascript">
$(window).load(function() {

';


echo $enterscr;
echo '

	$.backstretch("../pbg.jpg");


	$("input.color").keyup(function() {
		$(this).css("color",$(this).val());
	});

	$(".fsubmit").click(function () {        

		var form = $(this).attr("id");

		var data = $(".ajaxform").serialize();
 
		var win =  $("<span>saved. </span>").appendTo(".ajaxform").delay(1500).fadeOut("normal");
		
        $.ajax({  
            url: form,   
            type: "POST",       
            data: data,        
            cache: false,  
            success: win               
        });   
			
        return false; 	
		
    });   
	
	var mouseX = 0;
	var mouseY = 0;
	
	$("#edit").mousemove(function(e) {
        // track mouse position
		mouseX = e.pageX;
		mouseY = e.pageY;
	});  

    $("#edit").mousedown(function() {
        $("#minibar").fadeOut("1000");
    });

	$("#edit").select(function() {
		// get the mouse position an show the menu
		$("#minibar").css("top", mouseY - 30).css("left", mouseX + 70).fadeIn("1000");
	});

	$("#bold").click(function() {
		wrapText("<b>", "</b>");
		$("#minibar").fadeOut("1000");
	});

    $("#italic").click(function() {
		wrapText("<i>", "</i>");
		$("#minibar").fadeOut("1000");
	});
	
	$("#underline").click(function() {
		wrapText("<u>", "</u>");
		$("#minibar").fadeOut("1000");
	});

    $("#link").click(function() {
		var url = prompt("Enter URL", "http://");
		if (url != null)
			wrapText("<a href=" + url + ">", "</a>");
		$("#minibar").fadeOut("1000");
	});

	function wrapText(startText, endText){
		// Get the text before the selection
		var before = $("#edit").val().substring(0, $("#edit").caret().start);
		// Get the text after the selection
		var after = $("#edit").val().substring($("#edit").caret().end, $("#edit").val().length);
		// merge text before the selection, a selection wrapped with inserted text and a text after the selection
		$("#edit").val(before + startText + $("#edit").caret().text + endText + after);
		return false;
	}

	
});
</script>
</head>
</body>
	<div class="shell" id="box">
		<div class="inner" id="adminwrap">
			<div id="nav">
				<a href="../">return to site</a>
				<a href="?and=upload">upload</a>
				<a href="?and=settings">settings</a>
				<a href="?logout">log out</a><br><br>
				<span>edit files:</span>';
				echo $filelist;
				echo '
			</div>
			<div id="admin">';
				echo $pickedcontent;
				echo '
				<div id="minibar">
					<a href="#" id="bold">[b]</a>
					<a href="#" id="italic">[i]</a>
					<a href="#" id="underline">[u]</a>
					<a href="#" id="link">[link]</a>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
</body>
';
}
?>