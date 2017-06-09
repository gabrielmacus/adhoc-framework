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

    $t =$_GET["t"]; //tipo o seccion
    $site=$_GET["s"]; //Template

    $p =is_numeric( $_GET["p"])?$_GET["p"]: 1;

    $GLOBALS["postDAO"]->setLimit(2);
    $GLOBALS["postDAO"]->setPadding(3);
    $GLOBALS["postDAO"]->setActualPage($p);

    $fileVersion="original";

   $subsecciones =    $GLOBALS["seccionDAO"]->selectSeccionesByTipo($t);

    $seccionesTree=$GLOBALS["seccionDAO"]->selectSeccionesSubsecciones();

    $processFiles = true;
    $processAnexos=true;
    $action=$_GET["act"];
    switch ($action)
    {
        default:
            $processFiles=false;
            $processAnexos=false;
            $action="list";
            break;
        case "view":


            $seccion=  $GLOBALS["seccionDAO"]->selectSeccionById($t);
            break;
        case "save":
            
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


    $pg=$GLOBALS["postDAO"]->getPaginador();
    $actualPage=$GLOBALS["postDAO"]->getActualPage()+1;
    $pages =$GLOBALS["postDAO"]->getPages();

}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

    include DIR_PATH."/includes/panel/templates/comun/estructura.php";


