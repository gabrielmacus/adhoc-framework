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

           $res= $GLOBALS["menuDAO"]->saveMenu($_POST["sidenav"]);


            break;

        case "delete":

            break;

        case "list":

            break;



    }

    echo json_encode($res);

}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}




