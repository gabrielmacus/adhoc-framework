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

    $t =$_GET["t"];
    $site=$_GET["s"];
    $fileVersion="portada";

   $subsecciones =    $GLOBALS["seccionDAO"]->selectSeccionesByTipo($t);

    $processFiles = true;
    $processAnexos=true;
    $action=$_GET["act"];
    switch ($action)
    {
        default:
            $action="list";
            break;
        case "view":
            $seccion=  $GLOBALS["seccionDAO"]->selectSeccionById($t);
            break;
        case "save":
            $processFiles=false;
            $processAnexos=false;
            
            break;
    }


    if(is_numeric($_GET["id"]))
    {
        $post= $GLOBALS["postDAO"]->selectPostById($_GET["id"],$processFiles,$processAnexos);

    }
    else
    {

        $posts= $GLOBALS["postDAO"]->selectPostByTipo($t,$processFiles,$processAnexos);
    }


}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

    include DIR_PATH."/includes/panel/templates/comun/estructura.php";


