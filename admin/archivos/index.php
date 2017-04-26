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

    $p =is_numeric( $_GET["p"])?$_GET["p"]: 1;

    $GLOBALS["archivoDAO"]->setLimit(3);
    $GLOBALS["archivoDAO"]->setPadding(2);
    $GLOBALS["archivoDAO"]->setActualPage($p-1);

    $archivos= $GLOBALS["archivoDAO"]->selectArchivoByRepositorioId($_GET["rep"],true,["original"]);
    

    $site="archivos";
    $action="list";

}
catch (Exception $e)
{
    echo json_encode("Error: {$e->getMessage()}");

}

include DIR_PATH."/includes/panel/templates/comun/estructura.php";

