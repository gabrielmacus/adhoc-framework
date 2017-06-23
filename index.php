<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 03/04/2017
 * Time: 1:07
 */

include "includes/autoload.php";


$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";
$bodyClasses=[];

try{
    
    $clasificadosSeccionId=116;
    
    $site="home";
    $action="index";

}
catch (Exception $e)
{

    echo json_encode("Error: {$e->getMessage()}");

}

include DIR_PATH."/includes/site/templates/comun/estructura.php";
