<?php

	function fetchPosts($category){
		$category = (strlen($category) > 1) ? $category : 'all';
	  	// Load the XML source
		$xml = new DOMDocument;
		if($category == "all"){
			$feedURL = 'http://www.reddit.com/.rss';
		} else{
			$feedURL = 'http://www.reddit.com/r/' . $category . '/.rss';
		}
		$xml->load($feedURL);
		$xsl = new DOMDocument;
		$xsl->load('format-posts.xsl');

		// Configure the transformer
		$proc = new XSLTProcessor;
		$proc->importStyleSheet($xsl); // attach the xsl rules
		//$xsl = $proc ->setParameter('', 'category', $category);
		echo $proc->transformToXML($xml);
	}
?>
