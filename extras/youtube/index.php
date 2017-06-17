<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 16/06/2017
 * Time: 22:30
 */
include_once "../../includes/autoload.php";


// Create DOM from URL or file
$html = file_get_html('https://www.youtube.com/results?search_query=cerati');

// Find all images
foreach($html->find('.yt-lockup-title') as $element)
{
    $a =$element->find('a');
    foreach ($a as $item)
    {
        var_dump($item->href);
    }
}


