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

            $t =false;
            if(is_numeric($_GET["id"]))
            {
                $t=$_GET["id"];
                $secciones = $GLOBALS["seccionDAO"]->selectSeccionesByTipo($t);
            }
            else
            {
                $secciones=$GLOBALS["seccionDAO"]->selectSeccionesSubsecciones(true) ;
            }





            echo json_encode($secciones);

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




