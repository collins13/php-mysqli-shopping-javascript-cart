
<?php
function shortenText($text, $chars = 40){

	$text = $text." ";
	$text = substr($text, 0, $chars);
	$text = substr($text, 0, strrpos($text,' '));
	$text = $text."...";
	return $text;
} ?>
