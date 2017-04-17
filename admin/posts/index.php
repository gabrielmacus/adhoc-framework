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

    $tipo =43;
    $secciones=$GLOBALS["seccionDAO"]->selectSeccionesSubsecciones($tipo);




    switch ($_GET["act"])
    {
        default:
            if(is_numeric($_GET["id"]))
            {
                $post= $GLOBALS["postDAO"]->selectPostById($_GET["id"]);

            }
            else
            {
                $posts= $GLOBALS["postDAO"]->selectPosts();
            }


            $site="posts";
            $action="list";
            break;
        case "add":
            $imageVersion="post";
            if(is_numeric($_GET["id"]))
            {
                $post= $GLOBALS["postDAO"]->selectPostById($_GET["id"]);

            }



            $site="posts";
            $action="add";
            break;
    }

}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

include DIR_PATH."/includes/panel/templates/comun/estructura.php";
