<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/06/2017
 * Time: 03:04 PM
 */

include "includes/autoload.php";
$p=new PostDAO();

$post=$GLOBALS["postDAO"]->selectPostById(10);

$anexos=$post->getAnexos();
var_dump($anexos);