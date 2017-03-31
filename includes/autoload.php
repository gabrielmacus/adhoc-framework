<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 11:53 AM
 */

//cargo la configuracion aparte para tenerla disponible en todos los scripts
require_once "classes/schema/DataSource.php";
require_once "classes/schema/Configuracion/Configuracion.php";

$configuracion = new Configuracion( "173.236.78.206","test","sercan02","adhoc",
    "uipasd",0.1,"http://localhost/adhoc-framework","Adhoc Framework","Gamaware Web Tech",
    "adhoc-framework", "http://localhost/adhoc-framework","http://localhost/adhoc-framework");


require_once "classes/autoload-classes.php";//Cargo las clases

require_once "helpers/autoload-helpers.php";//Cargo las funciones utiles

/** DAOs**/

$userDAO = new UserDAO($configuracion->getDataSource());
$archivoDAO = new ArchivoDAO($configuracion->getDataSource());
$imagenDAO = new ImagenDAO($configuracion->getDataSource());
$repositorioDAO = new RepositorioDAO($configuracion->getDataSource());
$seccionDAO = new SeccionDAO($configuracion->getDataSource());
$comentarioDAO = new ComentarioDAO($configuracion->getDataSource());
$postDAO  = new PostDAO($configuracion->getDataSource());
/** **/



/*** Cosntantes **/

define("DIR_PATH",$_SERVER['DOCUMENT_ROOT']."/".$configuracion->getSiteFolder());
/**  */


$lang=json_decode(file_get_contents(DIR_PATH."/includes/lang/es.json"),true);