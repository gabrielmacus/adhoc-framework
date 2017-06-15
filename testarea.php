<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/06/2017
 * Time: 03:04 PM
 */

include "includes/autoload.php";
$p=new PostDAO();

$GLOBALS["postDAO"]->setFilters(
    array(

        "archivos"=>">=0",
        "anexos"=>">0",
        "anexosTypes"=>array(84)
    )

);
$post=$GLOBALS["postDAO"]->selectPosts();
var_dump($post);