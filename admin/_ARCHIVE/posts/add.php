<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 03/04/2017
 * Time: 1:07
 */

include "../../includes/autoload.php";

include_once DIR_PATH."/extras/api/check-login.php";
$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{


    $post = new Post();
    $post->setTitulo($_POST["titulo"]);
    $post->setTexto($_POST["texto"]);
    $post->setArchivos($_POST["archivos"]);
    $post->setSeccion($_POST["seccion"]);
    $post->setBajada($_POST["bajada"]);
    $post->setVolanta($_POST["volanta"]);
    $post->setExtra1($_POST["extra_1"]);
    $post->setExtra2($_POST["extra_2"]);
    $post->setExtra3($_POST["extra_3"]);
    $post->setExtra4($_POST["extra_4"]);
    $post->setAnexos($_POST["anexos"]);
    //$post->setAnexos(array(array("post_anexo_id"=>24)));


    if($_POST["id"])
    {

        $post->setId($_POST["id"]);
        echo json_encode($GLOBALS["postDAO"]->updatePost($post));
    }
    else
    { echo json_encode($GLOBALS["postDAO"]->insertPost($post));

    }




}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}