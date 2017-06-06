<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/06/2017
 * Time: 03:04 PM
 */

include "includes/autoload.php";
$p=new PostDAO();

$post=$GLOBALS["postDAO"]->selectPostById(11);

$anexos=$post->getAnexos();

foreach ($anexos as $grupo=>$v)
{
    foreach ($v as $clave=>$anexo)
    {
        $post=$GLOBALS["postDAO"]->selectPostById($anexo->getId());
        echo json_encode($post);
    }
}
