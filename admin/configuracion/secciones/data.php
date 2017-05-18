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

            $post = new Seccion();
            $post->setNombre($_POST["nombre"]);
            $post->setTipo($_POST["tipo"]);

            if ($_POST["id"]) {

                $post->setId($_POST["id"]);
                echo json_encode($GLOBALS["seccionDAO"]->updateSeccion($post));
            } else {
                echo json_encode($GLOBALS["seccionDAO"]->insertSeccion($post));

            }

            break;

        case "delete":

            echo json_encode($GLOBALS["seccionDAO"]->deleteSeccionById($_GET["id"]));

            break;

        case "list":

            $secciones=$GLOBALS["seccionDAO"]->selectSeccionesSubsecciones(false,true) ;

            echo json_encode($secciones);

            break;

    }


}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}




