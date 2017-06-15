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
echo json_encode($s);
echo "<br>";
$GLOBALS["postDAO"]->setFilters(
    array(

        "archivos"=>">=0",
        "seccion"=>array(103),
        "archivosExtensions"=>array("jpg"),
        "anexos"=>">=0",
        "anexosTypes"=>array(98),

    )

);
$post=$GLOBALS["postDAO"]->selectPosts();
var_dump($post);