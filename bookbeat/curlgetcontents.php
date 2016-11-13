<?php

# Author: Basuki Winoto
# File: curlgetcontents.php
# Description: function curl_get_contents does file_get_contents using curl


function curl_get_contents($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	$contents = curl_exec($curl);
	curl_close($curl);
	return $contents;
}

print(curl_get_contents("https://www.amazon.com/s/ref=nb_sb_noss?field-keywords=".urlencode("Programming Cucumber")));

?>