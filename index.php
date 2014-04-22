<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>OneK Reddit</title>
	<!--STYLES-->
	<link rel="stylesheet" href="style.css">
	<!--SCRIPTS-->
	<script src="scripts.js"></script>
</head>
<body>
	<?php 
		require_once "fetch-posts.php"; 
		$subreddit = (isset($_GET['subreddit'])) ? $_GET['subreddit'] : '';
		fetchPosts($subreddit);
	?>
</body>
</html>