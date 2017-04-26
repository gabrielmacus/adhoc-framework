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

    $GLOBALS["archivoDAO"]->setLimit(2);
    $GLOBALS["archivoDAO"]->setActualPage($p);

    if(is_numeric($_GET["id"]))
    {

        $repositorios= $GLOBALS["repositorioDAO"]->selectRepositorioById($_GET["id"]);
    }
    else
    {
        $repositorios=$GLOBALS["repositorioDAO"]->selectRepositorios(false) ;
    }


    $site="repositorios";
    $action="list";

}
catch (Exception $e)
{
    echo json_encode("Error: {$e->getMessage()}");

}

include DIR_PATH."/includes/panel/templates/comun/estructura.php";
