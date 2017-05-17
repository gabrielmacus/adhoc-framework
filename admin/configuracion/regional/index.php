<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 03/04/2017
 * Time: 1:07
 */

include "../../../includes/autoload.php";

include_once DIR_PATH."/extras/api/check-login.php";



$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{

    
   
    
    $idiomas = $GLOBALS["idiomaDAO"]->selectIdiomas();

    $i =new Idioma();
    $i->setShort("ES");
    $i->setNombre("Español");

    $idiomas->insertIdioma($i);
   $site="configuracion/regional";
    $action="list";



}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

include DIR_PATH."/includes/panel/templates/comun/estructura.php";
