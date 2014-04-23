<?php
	require_once "../fetch-posts.php";
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	ajax_fetchPosts("all", $page);
?>