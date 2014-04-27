<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>OneK Reddit</title>
	<!--STYLES-->
	<link rel="stylesheet" href="http://addison.im/oneK/style.css">
	<!--SCRIPTS-->
	<script type="text/javascript" src="http://addison.im/oneK/jquery.min.1.11.js"></script>
	<script type="text/javascript" src="http://addison.im/oneK/scripts.js"></script>

</head>
<body>
	<?php 
		require_once "fetch-posts.php"; 
		$URI = $_SERVER['REQUEST_URI'];
		$subreddit_string = (isset($_GET)) ? $_GET['subreddit'] : 'all';
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$next_page = $page + 1;
		$inputs = prepareInputs($URI, $subreddit_string, $page);
	?>
	<!--HEADER-->
	<header class="main">
		<h2><a href="http://addison.im/oneK/">Home</a></h2>
		<h3><a href="<?php $subU = ($inputs['category'] == "all") ? "#" : $inputs['category']; echo $subU ?>"><?php 
			$category_trimmed2 = ($inputs['category'] == "all") ? '<input type="search" placeholder="search subreddits" name="s"></input><input type="submit" id="searchSub" ></input>' : '/r/' . $inputs['category'];
			echo $category_trimmed2; 
		?></a></h3>
	</header><br/>
	<!--MAIN CONTENT-->
	<div class="wrapper">
	<?php
		fetchPosts($inputs['category'], $inputs['limit'], $inputs['after']);

		if($inputs['category'] == "all"):
	?>
			<a href=<?php echo '"&page=' . $next_page . '"'; ?> id="morePosts">Page <?php echo $next_page; ?></a>
	<?php elseif($page == 5): ?>
		<p>Sorry this site only goes back five pages right now. Check back for improvements!</p>
	<?php else: ?>
			<a href=<?php echo '"' . $inputs['category'] . '&page=' . $next_page . '"'; ?> id="morePosts">Page <?php echo $next_page; ?></a>
	<?php endif; ?>
</div>
</body>
</html>