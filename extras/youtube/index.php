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



foreach($html->find('.yt-lockup-title a') as $element)
{



        var_dump($element->href);
    var_dump($element->innertext);
}


