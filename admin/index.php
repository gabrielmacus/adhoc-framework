<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 03/04/2017
 * Time: 1:07
 */

include "../includes/autoload.php";

var_dump(DIR_PATH."/extras/api/check-login.php");
var_dump(file_exists(DIR_PATH."/extras/api/check-login.php"));

include_once DIR_PATH."/extras/api/check-login.php";

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Description";
$htmlLocality="Paraná,Entre Rios";

try{
    $site="home";
    $action="index";



}
catch (Exception $e)
{
    echo json_encode("Error: {$e->getMessage()}");

}

include DIR_PATH."/includes/panel/templates/comun/estructura.php";
