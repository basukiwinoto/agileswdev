<?php

# Author: Basuki Winoto
# File: scrapeamazon.php
# Description: function scrapeamazon takes a string book title keyword as an input and returns an array of the book title, sales rank, reviews and rating

function scrapeamazon($book_title){

	$book_search_url = "https://www.amazon.com/s/ref=nb_sb_noss?field-keywords=".urlencode($book_title);
	$page_content = file_get_contents($book_search_url);

	$dom_doc = new DOMDocument();
	libxml_use_internal_errors(true);
	$dom_doc->loadHTML($page_content);
	$xpath = new DOMXpath($dom_doc);

	$element = $xpath->query('//li[@id="result_0"]/div/div/div/div[2]/div[2]/a/@href');
	$search_result_url = $element->item(0)->nodeValue;

	$page_content = file_get_contents($search_result_url);

	$dom_doc = new DOMDocument();
	libxml_use_internal_errors(true);
	$dom_doc->loadHTML($page_content);
	$xpath = new DOMXpath($dom_doc);

	$element = $xpath->query('//span[@id="productTitle"]/text()');
	git $title = $element->item(0)->nodeValue;

	$element = $xpath->query('//li[@id="SalesRank"]/text()');
	$rank=preg_replace("/[^0-9]/","",$element->item(1)->nodeValue);

	$element = $xpath->query('//*[@id="acrCustomerReviewText"]/text()');
	$reviewers = preg_replace("/[^0-9]/","",$element->item(0)->nodeValue);

	$element = $xpath->query('//*[@id="avgRating"]/span/a/span/text()');
	$rating = floatval($element->item(0)->nodeValue);
	libxml_clear_errors();

	return array($title,$rank,$reviewers,$rating);
}


print_r(scrapeamazon("Programming Cucumber"))

?>