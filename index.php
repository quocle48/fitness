<?php 
$header=file_get_contents("header.html");
$banner=file_get_contents("banner.html");
$content=file_get_contents("content.html");
$footer=file_get_contents("footer.html");
echo $header.$banner.$footer;
?>