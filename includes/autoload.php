<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 11:53 AM
 */

//cargo la configuracion aparte para tenerla disponible en todos los scripts
/*
require("{$_SERVER['DOCUMENT_ROOT']}/includes/classes/schema/DataSource.php");
require("{$_SERVER['DOCUMENT_ROOT']}/includes/classes/schema/Configuracion/Configuracion.php");
*/
require("classes/schema/DataSource.php");
require("classes/schema/Configuracion/Configuracion.php");



$configuracion = new Configuracion("173.236.78.206","test","sercan02","adhoc",
    "uipasd",0.1,"http://localhost/adhoc-framework","Adhoc Framework","Gamaware Web Tech",
    "adhoc-framework", "http://localhost/adhoc-framework","http://localhost/adhoc-framework");


/*
$configuracion = new Configuracion("localhost","u427914340_adhoc","39717030","u427914340_adhoc",
    "uipasd",0.1,"http://mapuchepruebas.esy.es","Adhoc Framework","Gamaware Web Tech",
    "","http://mapuchepruebas.esy.es","http://mapuchepruebas.esy.es");
*/

require_once "classes/autoload-classes.php";//Cargo las clases

require_once "helpers/autoload-helpers.php";//Cargo las funciones utiles

/** DAOs**/

$GLOBALS["userDAO"]  = new UserDAO($configuracion->getDataSource());
$GLOBALS["archivoDAO"] = new ArchivoDAO($configuracion->getDataSource());
$GLOBALS["imagenDAO"] = new ImagenDAO($configuracion->getDataSource());
$GLOBALS["repositorioDAO"] = new RepositorioDAO($configuracion->getDataSource());
$GLOBALS["seccionDAO"] = new SeccionDAO($configuracion->getDataSource());
$GLOBALS["comentarioDAO"] = new ComentarioDAO($configuracion->getDataSource());
$GLOBALS["postDAO"]  = new PostDAO($configuracion->getDataSource());
$GLOBALS["configuracion"]  =$configuracion;


    /** **/

/** FB API **/
$GLOBALS["fbConfig"]=[
    'app_id' => '1874200559512926',
    'app_secret' => '28f2d83d08132603be62ab63435d4618',
    'default_graph_version' => 'v2.8',
    'permissions'=>['publish_actions','user_managed_groups']
];
/** **/

/** Gmaps API */
$GLOBALS["mapsConfig"]=array(
    'initialPosition'=>array("lat"=> -31.744444444444,"lng"=> -60.5175)
);

/** **/
/*** Constantes **/

define("DIR_PATH",$_SERVER['DOCUMENT_ROOT']."/".$configuracion->getSiteFolder());
/**  */



$lang=json_decode(file_get_contents(DIR_PATH."/includes/lang/{$configuracion->getLanguage()}.json"),true);
/*
//Cargo las secciones al menu
$secciones= $GLOBALS["seccionDAO"]->selectSeccionesByTipo(0);

foreach ($secciones as $seccion)
{
    $seccionNombre =strtolower($seccion->getNombre());
   $lang["sidenav"][]=array(  "text"=>$seccion->getNombre(),"items"=>array(
       array("text"=>"Agregar {$seccion->getNombre()}","href"=>$configuracion->getSiteAddress()."/admin/{$seccionNombre}/?act=add"),
       array("text"=>"Listar {$seccion->getNombre()}","href"=>$configuracion->getSiteAddress()."/admin/{$seccionNombre}/")

   ));

}

*/

set_time_limit(90);//Desarrollo