<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>OneK Reddit</title>
	<!--STYLES-->
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<?php 
		require_once "fetch-posts.php"; 
		$URL = $_SERVER['REQUEST_URI'];
		$category = explode("/", $URL);

		$subreddit_string = ($_GET['subreddit']) ? $_GET['subreddit'] : '';
		$category_string = isset($category[2]) ? $category[2] : '';
		fetchPosts($category_string);
	?>
	<a href="#" id="morePosts" onclick="return false">more</a>

	<div id="result">
	</div>
	<!--INCLUDE JQUERY-->
	<script src="jquery.min.1.11.js" ></script>
	<script>
		$(document).ready(function(){
			//  $.getScript()
		    var scriptUrl;
		    var count = 1;
		    
		    $("#morePosts").click(function(){
		    	count++;
		        scriptUrl = "/oneK/ajax/fetchPosts.php?page=" + count;
		    	console.log(scriptUrl);
		        $("#result").html("loading");
		      
	            $.getJSON(
	                scriptUrl,
	                function(json) {
	                    $("#result").html(json);
	                }
	            );
		        
		        return false;
		    });
		});
	</script>
</body>
</html>