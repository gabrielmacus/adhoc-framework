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


    $secciones=0;

    if(is_numeric($_GET["tipo"]))
    {
        $secciones=$GLOBALS["seccionDAO"]->selectSeccionesByTipo($_GET["tipo"]) ;

    }

    echo json_encode($secciones);
}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

