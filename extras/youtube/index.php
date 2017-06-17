<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 16/06/2017
 * Time: 22:30
 */
include_once "../../includes/autoload.php";


// Create DOM from URL or file
$html = file_get_html('http://www.google.com/');

// Find all images
foreach($html->find('img') as $element)
    echo $element->src . '<br>';

// Find all links
foreach($html->find('a') as $element)
    echo $element->href . '<br>';
