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


    if(is_numeric($_GET["id"]))
    {
        $post=$GLOBALS["postDAO"]->selectPostById($_GET["id"]);
    }

    $list="hoyos";
    $action="add";




}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}