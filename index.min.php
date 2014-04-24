<!doctype html>
<html>
<head>
	<meta charset="utf-8" >
</head>
<body>
<?php
 $URL=$_SERVER['REQUEST_URI'];$c=explode("/",$URL);$cS=(strlen($c[2])>1 and ($c[2][0]!="&"))?$c[2]:'all';$p=isset($_GET['page'])?$_GET['page']:1;$np=$p+1;$l=25*$p;$a=$l-25;$pn=stripos($cS,"&");$cT=strpos($cS,"&")?substr($cS,0,$pn):$cS;fP($cT,$l,$a);if($cT=="all"):?>
	<a href=<?php echo '"&page='.$next_page.'"';?> id="morePosts">Page <?php echo $next_page;?></a>
	<?php else:?>
			<a href=<?php echo '"'.$category_trimmed.'&page='.$next_page.'"';?> id="morePosts">Page <?php echo $next_page;?></a>
	<?php endif;function fP($cI,$lI,$aI){$xml=new DOMDocument;if($cI=="all" or strlen($cI)==0){$fU='http://www.reddit.com/.rss?lI='.$lI;}else{$fU='http://www.reddit.com/r/'.$cI.'.rss?lI='.$lI;}$xml->load($fU);$xsl=new DOMDocument;$xsl->load('format-posts.xsl');$proc=new XSLTProcessor;$proc->importStyleSheet($xsl);$xsl=$proc->setParameter('','aI',$aI);echo $proc->transformToXML($xml);}?>
</body>
</html>