<?php


ob_start();//Importante para que cree un buffer antes de enviar



/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 11:53 AM
 */

//cargo la configuracion aparte para tenerla disponible en todos los scripts

/*
require("{$_SERVER['DOCUMENT_ROOT']}/admin/includes/classes/schema/DataSource.php");
require("{$_SERVER['DOCUMENT_ROOT']}/admin/includes/classes/schema/Configuracion/Configuracion.php");
*/

require("classes/schema/DataSource.php");
require("classes/schema/Configuracion/Configuracion.php");



/*
$configuracion = new Configuracion("localhost","c0580153_adhoc","Mapuche17","c0580153_adhoc",
    "uipasd",0.1,"http://footgolf.mapucheonline.com","Adhoc Framework","Gamaware Web Tech",
    "test", "http://footgolf.mapucheonline.com","http://footgolf.mapucheonline.com");
*/

$configuracion = new Configuracion("localhost","c0580153_adhoc","Mapuche17","c0580153_adhoc",
    "uipasd",0.1,"http://admin.mapucheonline.com","Adhoc Framework","Gamaware Web Tech",
    "", "http://admin.mapucheonline.com","http://admin.mapucheonline.com");

$configuracion->setDefaultImageSizes(

    array(
      "panel_repositorio:300x300"
    )

);
$configuracion->setHtdocsFolder("public_html");
$configuracion->setDbEncoding("latin_1");

$GLOBALS["configuracion"]  =$configuracion;


/*
$configuracion = new Configuracion("localhost","c0580153_adhoc","Mapuche17","c0580153_adhoc",
    "uipasd",0.1,"http://mapucheonline.com/test/admin","Adhoc Framework","Gamaware Web Tech",
    "","http://mapucheonline.com/test/admin","http://mapucheonline.com/test/admin");
*/

require_once "classes/autoload-classes.php";//Cargo las clases
require_once "helpers/autoload-helpers.php";//Cargo las funciones utiles
/*** Constantes **/

define("DIR_PATH",$_SERVER['DOCUMENT_ROOT']."/".$configuracion->getSiteFolder());

/**  */

/** DAOs**/

$GLOBALS["userDAO"]  = new UserDAO($configuracion->getDataSource());
$GLOBALS["archivoDAO"] = new ArchivoDAO($configuracion->getDataSource());
$GLOBALS["imagenDAO"] = new ImagenDAO($configuracion->getDataSource());
$GLOBALS["documentoDAO"] = new DocumentoDAO($configuracion->getDataSource());
$GLOBALS["repositorioDAO"] = new RepositorioDAO($configuracion->getDataSource());
$GLOBALS["seccionDAO"] = new SeccionDAO($configuracion->getDataSource());
$GLOBALS["comentarioDAO"] = new ComentarioDAO($configuracion->getDataSource());
$GLOBALS["postDAO"]  = new PostDAO($configuracion->getDataSource());
$GLOBALS["idiomaDAO"] = new IdiomaDAO($configuracion->getDataSource());
$GLOBALS["youtubeDAO"] = new VideoYTDAO($configuracion->getDataSource());
$GLOBALS["audioDAO"]= new AudioDAO($configuracion->getDataSource());
$GLOBALS["vimeoDAO"]=new VideoVMDAO($configuracion->getDataSource());
$GLOBALS["videoDAO"] = new VideoDAO($configuracion->getDataSource());

$GLOBALS["menuDAO"] = new MenuDAO(DIR_PATH."/includes/panel/templates/comun/lang/{$configuracion->getLanguage()}.json");



    /** **/

/** FB API **/
$GLOBALS["fbConfig"]=[
    'app_id' => '1031945323602658',
    'app_secret' => 'a111fac77eb8bc66da8325858026ac5a',
    'default_graph_version' => 'v2.9',
    'permissions'=>['public_profile','user_friends','email'],
    'fields'=>['id','about','birthday','gender','first_name','last_name','picture']
];
/** **/

/** Gmaps API */
$GLOBALS["mapsConfig"]=array(
    'initialPosition'=>array("lat"=> -31.744444444444,"lng"=> -60.5175)
);

/** **/
$s =   $GLOBALS["seccionDAO"] ->selectSeccionesSubsecciones();

$secciones=array();

foreach ($s as $sec)
{
    $secciones[$sec->getId()]=$sec;
}


$lang=json_decode(file_get_contents(DIR_PATH."/includes/panel/templates/comun/lang/{$configuracion->getLanguage()}.json"),true);

//Autoload del sitio
include "site/autoload.php";

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

//set_time_limit(30);

