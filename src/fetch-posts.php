<?php
	
	function prepareInputs($URL, $subreddit, $page){
		$category = explode("/", $URL);
		$category_string = (strlen($category[2]) > 1 and ($category[2][0] != "&")) ? $category[2] : 'all';
		$next_page = $page + 1;
		$limit = 25*$page;
		$after = $limit - 25;
		$position = stripos($category_string, "&");
		$category_trimmed = strpos($category_string, "&") ? substr($category_string, 0, $position) : $category_string;
		$preparedInputs = array("category" => $category_trimmed, "position" => $position, "limit" => $limit, "after" => $after);
		return $preparedInputs;
	}

	function fetchPosts($category, $limit, $after){
	  	// Load the XML source
		$xml = new DOMDocument;
		if($category == "all" or strlen($category) == 0){
			$feedURL = 'http://www.reddit.com/.rss?limit=' . $limit;
		} else{
			$feedURL = 'http://www.reddit.com/r/' . $category . '.rss?limit=' . $limit;
		}
		//echo $feedURL . "<br/>";
		$xml->load($feedURL);
		$xsl = new DOMDocument;
		$xsl->load('format-posts.xsl');

		// Configure the transformer
		$proc = new XSLTProcessor;
		$proc->importStyleSheet($xsl); // attach the xsl rules
		$xsl = $proc ->setParameter('', 'after', $after);
		echo $proc->transformToXML($xml);
	}

	/**
	 * Class to parse RSS feed (pure PHP approach instead of using XSLT)
	 * list_posts method prints out posts of RSS feed with html tags
	 */
	class fetchRedditPosts {
		// Initialize variables
		private $feedURL;
		private $category;
		private $limit;
		private $after;
		private $rss;


		// Load feed url and initialize dates
		public function __construct($category, $limit, $after){
			$this->after = $after;
			if($category == "all" or strlen($category) == 0){
				$this->feedURL = 'http://reddit.com/.rss?limit=' . $limit;
			} else{
				$this->feedURL = 'http://reddit.com/r/' . $category . '.rss?limit=' . $limit;
			}
			$this->feedURL = mb_convert_encoding($this->feedURL, "UTF-8");
			$this->rss = simplexml_load_file($this->feedURL);
		}

		public function list_posts(){
			$i = 1;   
			$results = "";
			/*Display News Items*/
			foreach ($this->rss->channel->item as $feedItem) {
				if($i > $this->after){
					$results .= '<ul class="post">' . "\n";
					$results .= '<li><a href="'. $feedItem->link. '" target="_blank">' . $feedItem->title .'</a></li>' . "\n";
					if(!strpos($feedItem->description, "img") or !strpos($feedItem->description, "gifs")){
						$results .= '<li><img src="http://placehold.it/75x75" /></li>';
					}
					$results .= "<li>". $feedItem->description . "</li>\n";
					$results .=  "</ul>\n";
					$i++;
				}
		}

		return $results;
	} #END METHOD

}

?>
