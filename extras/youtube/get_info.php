<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 22/06/2017
 * Time: 11:18 AM
 */


$url="https://www.youtube.com/oembed?url={$_GET["url"]}&format=json";

echo file_get_contents($url);


