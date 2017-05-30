<?php
function title_seo($text){
	$char_del = array("–","(",")","\"",".",",",":");
	$text = str_replace($char_del,"",$text);
	$replaces = array(" ",",","%","@","&","/","?");
	$uri_text = str_replace($replaces,'-',$text);
	return strtolower($uri_text);
}
?>
