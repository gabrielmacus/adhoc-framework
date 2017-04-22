<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 12:25 PM
 */


require_once "schema/Archivo/ArchivoDAO.php";
require_once "schema/Imagen/ImagenDAO.php";
header('Location: http://google.com.ar', true, 302);
require_once "schema/Repositorio/RepositorioDAO.php";

require_once "schema/Usuario/UserDAO.php";
require_once "schema/Seccion/SeccionDAO.php";
require_once "schema/Comentario/ComentarioDAO.php";
require_once "schema/Post/PostDAO.php";
/** ImageResize **/
require_once "ImageResize.php";
/*** **/

/** FTP **/
require_once "schema/FtpClient/FtpClient.php";
require_once "schema/FtpClient/FtpException.php";
require_once "schema/FtpClient/FtpWrapper.php";
/** **/

/** Facebook API**/

require_once "schema/Facebook/autoload.php";

/** **/

/** JWT **/
require_once "JWT/JWT.php";
/**  ** */
