<?php



/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 23/04/2017
 * Time: 21:29

 */

include "../../../includes/autoload.php";
//include_once DIR_PATH."/extras/api/check-login.php"; TODO agregar usuarios con sus permisos

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{


    switch ($_GET["act"])
    {


        case "save":


            break;

        case "delete":

            break;

        case "list":

            break;



    }

    /*    $langFile= DIR_PATH."/includes/comun/lang/{$GLOBALS["configuracion"]->getLanguage()}.es";
    
        $fileContents= json_decode(file_get_contents($langFile),true);
    
        $sidenav=$fileContents["sidenav"];
    
        $fileContents["sidenav"]=$sidenav;
    
        file_put_contents($langFile,json_decode($fileContents));
    */

}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}




