<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 12:22 PM
 */
include "includes/autoload.php";

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{


    $posts=$GLOBALS["postDAO"]->selectPosts();
    foreach ($posts as $p)
    {
        $archivos=$p->getArchivos();
        var_dump($archivos[1][59]["original"]->getRepositorio());
    }




}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

include DIR_PATH."/includes/templates/comun/estructura.php";
