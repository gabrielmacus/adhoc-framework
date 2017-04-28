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

try{
    $site="home";
    $action="index";


}
catch (Exception $e)
{

    echo json_encode("Error: {$e->getMessage()}");

}
var_dump(DIR_PATH);

include DIR_PATH."/includes/site/templates/comun/estructura.php";
