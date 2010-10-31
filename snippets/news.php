<?php

$feedurl = 'http://rss.cnn.com/rss/edition.rss';


  $doc = new DOMDocument();
  $doc->load($feedurl);
  $arrFeeds = array();
  foreach ($doc->getElementsByTagName('item') as $key => $node) {
    if ($key > 2){break;}

	$itemRSS = $node->getElementsByTagName('description')->item(0)->nodeValue;
    array_push($arrFeeds, $itemRSS);
  }
?>

