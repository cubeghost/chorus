<?php
include 'header.php';
?>

<style> 
</style>

<body>	
<div id="taco">
	<h2>this is <a href="http://mangouste.net/">goose</a>'s academic portfolio.</h2>
	<div class="links">
		<?php echo $content['index_links.txt']; ?>
	</div>
</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25040530-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
