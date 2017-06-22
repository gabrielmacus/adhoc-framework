<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 22/06/2017
 * Time: 11:18 AM
 */



include_once "../../includes/autoload.php";

var_dump(HTTPrequest($_GET["https://www.youtube.com/oembed?url={$_GET["url"]}&format=json"]));



