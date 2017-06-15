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
        "archivosExtensions"=>array("jpg"),
        "anexos"=>">=0",
        "anexosTypes"=>array(98),
        "seccion"=>array(105)
    )

);
$post=$GLOBALS["postDAO"]->selectPosts();
var_dump($post);