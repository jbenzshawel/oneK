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
		$category_string = (isset($category[2]) and ($category[2][0] != "&")) ? $category[2] : 'all';
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$next_page = $page + 1;
		$limit = 25*$page;
		$after = $limit - 25;
		$position = stripos($category_string, "&");
		$category_trimmed = strpos($category_string, "&") ? substr($category_string, 0, $position) : $category_string;
		fetchPosts($category_trimmed, $limit, $after);
		
		if($category_trimmed == "all"):
	?>
			<a href=<?php echo '"&page=' . $next_page . '"'; ?> id="morePosts">Page <?php echo $next_page; ?></a>
	<?php elseif($page == 5): ?>
		<p>Sorry this site only goes back five pages right now. Check back for improvements!</p>
	<?php else: ?>
			<a href=<?php echo '"' . $category_trimmed . '&page=' . $next_page . '"'; ?> id="morePosts">Page <?php echo $next_page; ?></a>
	<?php endif; ?>
</body>
</html>