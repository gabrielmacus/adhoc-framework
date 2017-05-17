<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 23/04/2017
 * Time: 21:29

 */

include "../../../../includes/autoload.php";
//include_once DIR_PATH."/extras/api/check-login.php"; TODO agregar usuarios con sus permisos

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{


    switch ($_GET["act"])
    {
        case "save":

            $post = new Idioma();
            $post->setShort($_POST["short"]);
            $post->setNombre($_POST["name"]);
            $post->setPredeterminado($_POST["predeterminado"]);

            if ($_POST["id"]) {

                $post->setId($_POST["id"]);
                echo json_encode($GLOBALS["idiomaDAO"]->updateIdioma($post));
            } else {
                echo json_encode($GLOBALS["idiomaDAO"]->insertIdioma($post));

            }

            break;

        case "delete":
            echo json_encode($GLOBALS["idiomaDAO"]->deleteIdiomaById($_GET["id"]));

            break;

    }


}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}




