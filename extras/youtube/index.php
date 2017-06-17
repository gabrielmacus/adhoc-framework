<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 16/06/2017
 * Time: 22:30
 */
include_once "../../includes/autoload.php";

include "url_parser.php";

// Create DOM from URL or file
$html = file_get_html("https://www.youtube.com/results?search_query={$_GET["q"]}&sp=EgIQAQ%253D%253D");


$videos=array();

foreach($html->find('.yt-lockup-title a') as $element)
{

    $video["href"]="https://www.youtube.com".$element->href;
    $video["title"]=$element->innertext;
    $videos[]=$video;

}


var_dump($videos);