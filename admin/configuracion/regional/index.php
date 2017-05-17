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

   $idioma = new Idioma();
    $idioma->setId(2);
    $idioma->setPredeterminado(1);
    $idioma->setNombre("Español");
    $idioma->setShort("ES");
    $GLOBALS["idiomaDAO"]->updateIdioma($idioma);
    
    $idiomas = $GLOBALS["idiomaDAO"]->selectIdiomas();

   $site="configuracion/regional";
    $action="list";



}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

include DIR_PATH."/includes/panel/templates/comun/estructura.php";
