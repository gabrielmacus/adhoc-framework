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
    foreach ($grupo as $clave=>$anexo)
    {
        var_dump($anexo);
    }
}
