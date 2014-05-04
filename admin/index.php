<?php
session_start();

if(empty($_SESSION['admin'])) { 
?>
<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	<link rel="stylesheet" href="style.css?2" type="text/css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>	
	<script>
		$(document).ready(function() { 
			$("[name=login]").click(function() { 
			    //check the username exists or not from ajax
		        $.post("login.php",{ username:$("[name=username]").val(),password:$("[name=password]").val(),rand:Math.random() } ,function(data) {
					if(data=="yes") {
						$(".nyoom").animate({ 
							top: "240px"
						}, 300 );			
						$(".nyoom").animate({ 
							top: "-800px"
						}, 600, 
						function() {
							document.location="";
						});
					}
					else if(data="no") {
						$(".nyoom").effect("shake", { times:3 }, 80);
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
<section class="nyoom">
	<form id="login">
		<input type="text" name="username" class="delta" placeholder="username"><br>
		<input type="password" name="password" class="delta" placeholder="password"><br>
		<input type="submit" name="login" value="log in" id="flogin"> 
	</form>
</section>
</body>
</html>';
<?php } else { 

$texts = scandir('../txt/');
foreach($texts as $text) {
    if (is_file('../txt/'.$text) == true) {
        $txt_content = file_get_contents('../txt/'.$text);
        $txt[$text] = $txt_content;
        $txtlist .= '<a href="?edit='.$text.'" class="delta">'.$text.'</a>';
    }
}

$files = scandir('../');
foreach($files as $file) {
    if (is_file('../'.$file) == true) {
        $file_content = file_get_contents('../'.$file);
        $files[$file] = $file_content;
        $filelist .= '<a href="?edit='.$file.'&type=file" class="delta">'.$file.'</a>';
    }
}

$settings = parse_ini_file("settings.ini");

foreach ($settings as $key => $value) {
	if (preg_match('/^#/', $value) && strlen($value) == 7) {
		$valuehex = trim($value, "#");
		if (ctype_xdigit($valuehex)) {
			$hexclass = ' color';
		}
	}
	$settingsform .= '<label for="' . $key . '">' . $key . ' </label><input type="text" class="delta' . $hexclass . '" name="' . $key . '" placeholder="' . $key . '" value="' . $value . '">';
}


$editing = $_GET['edit'];
$type = $_GET['type'];
$view = $_GET['view'];

if ($type == 'file') {
	$dir = '../';
	$editor = "var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('edit'),{
		lineNumbers: true,
		lineWrapping: true,
		theme: 'monokai'
	});";
} else {
	$dir = '../txt/';
	$editor = "
		$('.summernote').summernote({
			  toolbar: [			     
			    ['style', ['bold', 'italic', 'clear']],
			    ['insert', ['picture', 'link']],
			    ['para', ['ul', 'ol']],
			    ['control', ['undo', 'redo']],
			    ['code', ['codeview']]
			  ],
			  styleWithSpan: false,
			  codemirror: {
				  theme: 'monokai',
				  lineWrapping: true
			  }
		});";
}

if (empty($editing)) {
	//home
	if (!empty($view)) {
		$showzeta = 'display:block!important;';
		$hideform = 'display:none!important;';
		if ($view == 'uploads') {
			$uploads = scandir('../upload/');
			$uploadlist = '<h1>viewing upload folder <a href="./" class="back">close</a></h1>';
			foreach($uploads as $upload) {
				if (is_file('../upload/'.$upload) == true) {
			        $uploadlist .= '<a href="../upload/'.$upload.'" class="delta uploads" target="_blank">'.$upload.'</a>';
			    }
			}
			$viewpage = $uploadlist;
		} else if ($view == 'help') {
			$viewpage = '<h1>instructions</h1>';
		}
	} 
} else {
	$showzeta = 'display:block!important;';
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>	
	
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
	<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script> 
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.css" />
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.min.css" />
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/htmlmixed/htmlmixed.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/php/php.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/addon/mode/multiplex.min.js"></script>

	<link href="lib/summernote.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="lib/summernote.min.js"></script>
	
	<script type="text/javascript" src="lib/dropzone.js"></script>
	<link href="lib/dropzone_basic.css" rel="stylesheet" type="text/css">

	<link href="http://fonts.googleapis.com/css?family=PT+Sans:400italic,400,700italic,700" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet" type="text/css">
	
	<link href="style.css?10" rel="stylesheet" type="text/css">

	<script type="text/javascript">
	$(document).ready(function() {
		    
		<?=$editor;?>

		$("form.settings").submit(function(e){        
			var setdata = $(this).serialize();
	        $.ajax({  
	            url: 'save_set.php',   
	            type: 'POST',       
	            data: setdata,        
	            success: function(){
		            window.location = window.location.pathname;
	            }             
	        });   
	        event.preventDefault(); 	
	    });   
		
		$(".edit_form").submit(function(e){        
			var postdata = $(this).serialize();
			var win =  $('<span class="saved">\u2714</span>').insertAfter('.edit_submit').delay(1000).fadeOut("normal");
	        $.ajax({  
	            url: 'save.php',   
	            type: 'POST',       
	            data: postdata,        
	            success: win               
	        });   
	        event.preventDefault(); 	
	    });   
	
		$('.gamma.files .delta:not(.toggle)').hide();
		$('.gamma.files .delta.toggle').css({'border-bottom':'0'}).addClass('closed');
		
		$('.toggle').click(function(){
			if ($(this).hasClass('closed')) {
				$(this).parent('.gamma.files').children('.delta:not(.toggle)').slideDown('normal');
				$(this).css({'border-bottom':'1px #ddd solid'}).removeClass('closed').addClass('open');
				$(this).text('hide files');
			} else {
				$(this).parent('.gamma.files').children('.delta:not(.toggle)').slideUp('normal');
				$(this).css({'border-bottom':'0'}).removeClass('open').addClass('closed');
				$(this).text('show files');
			}
			event.preventDefault();
		});
		
		$('input.color').keyup(function() {
			$(this).css('color',$(this).val());
		});		

		$('a.add.settings').click(function(){
			console.log('clicked');
			$('.settings_submit').before('<label for="newsetting" contenteditable="true" class="newsetting">[name] </label><input type="text" class="delta" name="newsetting" placeholder="[new setting]" value="">');
			$('.newsetting').focusout(function(){
				var settingname = $(this).text();
				$(this).attr('for',settingname);
				$(this).next().attr('name',settingname).attr('placeholder',settingname);
			});
			event.preventDefault();
		});
		
		$('.dropzone').on('click','.dz-preview',function(){
			var filename = '../upload/' + $(this).find('.dz-filename span').text();
			window.open(filename,'_blank'); 
		});

		
		//nothing after this
		$('.icon-code').trigger('click');	
	});
	</script>
	
	<style type="text/css">
		.zeta {<?=$showzeta;?>}
		.zeta .edit_form {<?=$hideform;?>}
	</style>
</head>
<body>
	<section class="alpha">
		<section class="beta">
			<article>
				<h1>edit content</h1>
				<nav class="gamma content">
					<?=$txtlist;?>
				</nav>
			</article>
			<article>
				<h1>edit files</h1>
				<nav class="gamma files">
					<a href="#" class="delta toggle">show files</a>
					<?=$filelist;?>
				</nav>
			</article><br>
			<article>
				<h1>settings <a href="#" class="add settings">+</a></h1>
				<form class="gamma settings" action="save_set.php" method="POST">
					<?=$settingsform;?>
					<input type="submit" value="save settings" class="settings_submit">
				</form>
			</article><br>
			<article>
				<h1>upload</h1>
				<form class="gamma upload dropzone" action="upload.php">
				
				</form>
				<a href="?view=uploads" class="gamma view">view uploads</a>
			</article><br>
			<article>
				<h1><a href="logout.php">log out</a><a href="?view=help" class="help">help</a></h1>
			</article>
		</section>
		<section class="zeta">
			<?=$viewpage;?>
			<form class="edit_form" action="save.php" method="POST">
				<input type="hidden" name="dir" value="<?=$dir;?>">
				<input type="hidden" name="file" value="<?=$editing;?>">
				<h1>editing <?=$editing;?> &nbsp;&nbsp;&nbsp;<input type="submit" value="save" class="edit_submit"><a href="./" class="back">close</a></h1>
				<textarea class="summernote edit" name="edit" id="edit"><?=$txt[$editing];?><?=$files[$editing];?></textarea>
			</form>
		</section>
		<section class="omega">
			<p>It does not matter how slow you go so long as you do not stop.</p>
		</section>
	</section>
</body>
</html>
<?php } ?>