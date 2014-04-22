<?php

	function fetchPosts($category){
	  	// Load the XML source
		$xml = new DOMDocument;
		$xml->load('http://www.reddit.com/.rss');
		$xsl = new DOMDocument;
		$xsl->load('format-posts.xsl');

		// Configure the transformer
		$proc = new XSLTProcessor;
		$proc->importStyleSheet($xsl); // attach the xsl rules

		echo $proc->transformToXML($xml);
	}
?>
