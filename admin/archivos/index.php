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
    $limit= 15;
    $padding=6;
    $versionPanel="panel_repositorio";
    $p =is_numeric( $_GET["p"])?$_GET["p"]: 1;

    $GLOBALS["archivoDAO"]->setLimit($limit);
    $GLOBALS["archivoDAO"]->setPadding($padding);
    $GLOBALS["archivoDAO"]->setActualPage($p);

    $r =explode(",",$_GET["rep"]);
    $filters=    array(
        "repositorios"=>$r
    );


    $GLOBALS["archivoDAO"]->setFilters(
    $filters
    );

    $archivos= $GLOBALS["archivoDAO"]->selectArchivos();


    $pg=$GLOBALS["archivoDAO"]->getPaginador();
    $actualPage=$GLOBALS["archivoDAO"]->getActualPage()+1;
    $pages =$GLOBALS["archivoDAO"]->getPages();



    $site="archivos";
    $action="list";

}
catch (Exception $e)
{
    echo json_encode("Error: {$e->getMessage()}");

}

include DIR_PATH."/includes/panel/templates/comun/estructura.php";

