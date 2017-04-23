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

    $t =$_GET["t"];
    $site=$_GET["s"];

   // $subsecciones =    $GLOBALS["seccionDAO"]->selectSeccionesByTipo($t);

    if(is_numeric($_GET["id"]))
    {
        $post= $GLOBALS["postDAO"]->selectPostById($_GET["id"]);

    }
    else
    {
        $posts= $GLOBALS["postDAO"]->selectPostByTipo($t);
    }

    if(!($action=$_GET["act"]))
    {
        $action="list";
    }
    switch ($action)
    {
        case "list":
        default:

            break;

        case "save":
            //TODO
            //loadValidation($t)




            break;
    }


}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

if($_GET["async"])
{
    echo json_encode($posts);
}
else
{
    include DIR_PATH."/includes/panel/templates/comun/estructura.php";
}

