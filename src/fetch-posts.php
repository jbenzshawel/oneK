<?php

	function fetchPosts($category, $limit, $after){
	  	// Load the XML source
		$xml = new DOMDocument;
		if($category == "all" or strlen($category) == 0){
			$feedURL = 'http://www.reddit.com/.rss?limit=' . $limit;
		} else{
			$feedURL = 'http://www.reddit.com/r/' . $category . '.rss?limit=' . $limit;
		}
		$xml->load($feedURL);
		$xsl = new DOMDocument;
		$xsl->load('format-posts.xsl');

		// Configure the transformer
		$proc = new XSLTProcessor;
		$proc->importStyleSheet($xsl); // attach the xsl rules
		$xsl = $proc ->setParameter('', 'category', $category);
		$xsl = $proc ->setParameter('', 'after', $after);
		echo $proc->transformToXML($xml);
	}
?>
