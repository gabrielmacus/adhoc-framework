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
    $GLOBALS["postDAO"]->setOrderBy(" post_creacion DESC");
    $limit= 15;
    $padding=6;

    $t =$_GET["t"]; //tipo o seccion
    $site=$_GET["s"]; //Template

    $p =is_numeric( $_GET["p"])?$_GET["p"]: 1;

    $GLOBALS["postDAO"]->setLimit($limit);
    $GLOBALS["postDAO"]->setPadding($padding);
    $GLOBALS["postDAO"]->setActualPage($p);

    $fileVersion="original";


    $processFiles = true;
    $processAnexos=true;
    $action=$_GET["act"];
    switch ($action)
    {
        default:
            $processFiles=false;
            $processAnexos=false;
            $action="list";
            break;
        case "view":


            $seccion=  $GLOBALS["seccionDAO"]->selectSeccionById($t);
            break;
        case "save":


            $subsecciones =    $GLOBALS["seccionDAO"]->selectSeccionesByTipo($t);

            //$seccionesTree=$GLOBALS["seccionDAO"]->selectSeccionesSubsecciones();



            break;
    }


    if(is_numeric($_GET["id"]))
    {

        $post= $GLOBALS["postDAO"]->selectPostById($_GET["id"],$processFiles,$processAnexos);

    }
    else
    {

        $seccionesBreadcrumb=$GLOBALS["seccionDAO"]->selectCompleteSeccionBreadcrumb($t);

        $s=array_map(function($value){

            return $value->getId();
        },$seccionesBreadcrumb);

        $s[]=$t;

        $filters=array(

            "seccion"=>$s,


        );

        switch ($_GET["anx"])
        {
            case "0":
                $filters["anexos"] ="=0";
                break;
            case "1":
                $filters["anexos"] =">0";
                break;
        }

        switch ($_GET["adj"])
        {
            case "0":
                $filters["archivos"] ="=0";
                break;
            case "1":
                $filters["archivos"] =">0";
                break;
        }

        if(!empty(trim($_GET["q"])))
        {
            $filters["q"]=$_GET["q"];
        }

        $GLOBALS["postDAO"]->setFilters(
            $filters

        );
        $posts=    $GLOBALS["postDAO"]->selectPosts($processFiles,$processAnexos);

      //  $posts= $GLOBALS["postDAO"]->selectPostByTipo($t,$processFiles,$processAnexos);
    }


    $pg=$GLOBALS["postDAO"]->getPaginador();
    $actualPage=$GLOBALS["postDAO"]->getActualPage()+1;
    $pages =$GLOBALS["postDAO"]->getPages();

}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

    include DIR_PATH."/includes/panel/templates/comun/estructura.php";


