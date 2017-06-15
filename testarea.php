<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/06/2017
 * Time: 03:04 PM
 */

include "includes/autoload.php";
$p=new PostDAO();


$s=$GLOBALS["seccionDAO"]->selectCompleteSeccionBreadcrumb(84);

$s=array_map(function($value){

   return $value["id"];
},$s);


$GLOBALS["postDAO"]->setFilters(
    array(

        "archivos"=>">=0",
        "seccion"=>$s,
        "archivosExtensions"=>array("jpg"),
        "anexos"=>">=0",
        "anexosTypes"=>array(98),

    )

);
$post=$GLOBALS["postDAO"]->selectPosts();
var_dump($post);