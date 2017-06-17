<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 16/06/2017
 * Time: 22:30
 */


include_once "../../includes/autoload.php";


include "url_parser.php";
// el parametro sp es para que solo me traiga videos
$html = file_get_html("https://www.youtube.com/results?search_query={$_GET["q"]}&sp=EgIQAQ%253D%253D");


$videos=array();

foreach($html->find('.yt-lockup-title a') as $element)
{

    $video["href"]="https://www.youtube.com".$element->href;
    $videoId=  $video["href"];
    $video["title"]=$element->innertext;


    $videos[]=$video;




}

echo json_encode($videos);