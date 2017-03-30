<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 11:53 AM
 */

require_once "classes/autoload-classes.php";//Cargo las clases

require_once "helpers/autoload-helpers.php";//Cargo las funciones utiles


$configuracion = new Configuracion( "173.236.78.206","test","sercan02","adhoc",
    "uipasd",0.1,"http://localhost/adhoc-framework","Adhoc Framework","Gamaware Web Tech",
    "adhoc-framework", "http://localhost/adhoc-framework","http://localhost/adhoc-framework");

/** DAOs**/

$userDAO = new UserDAO($configuracion->getDataSource());
$archivoDAO = new ArchivoDAO($configuracion->getDataSource());
$imagenDAO = new ImagenDAO($configuracion->getDataSource());
$repositorioDAO = new RepositorioDAO($configuracion->getDataSource());


/** **/

/*** Cosntantes **/

define("DIR_PATH",$_SERVER['DOCUMENT_ROOT']."/".$configuracion->getSiteFolder());
/**  */


$lang=json_decode(file_get_contents(DIR_PATH."/includes/lang/es.json"),true);