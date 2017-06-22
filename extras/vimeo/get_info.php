<?php

include_once "../../includes/autoload.php";


// el parametro sp es para que solo me traiga videos
$html = file_get_html("{$_GET["url"]}");

$text=$html->find("script[type='application/ld+json']",0)->innertext;

echo $text;