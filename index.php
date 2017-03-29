<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 12:22 PM
 */
include "includes/autoload.php";
$htmlTitle=$configuracion->getSiteName();

try{




}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

include DIR_PATH."/includes/templates/comun/estructura.php";
