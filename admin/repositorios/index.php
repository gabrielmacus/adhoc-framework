<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 03/04/2017
 * Time: 1:07
 */

include "../../includes/autoload.php";

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{




    if(is_numeric($_GET["id"]))
    {
  
       $repositorio= $GLOBALS["repositorioDAO"]->selectRepositorioById($_GET["id"]);
    }

    var_dump($repositorio);
    $site="repositorios";
    $action="list";
}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

include DIR_PATH."/includes/panel/templates/comun/estructura.php";
