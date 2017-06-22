<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 12:25 PM
 */

require_once "schema/Paginador/Paginable.php";
require_once "schema/Archivo/ArchivoDAO.php";
require_once "schema/Imagen/ImagenDAO.php";
require_once "schema/Repositorio/RepositorioDAO.php";
require_once "schema/Usuario/UserDAO.php";
require_once "schema/Seccion/SeccionDAO.php";
require_once "schema/Comentario/ComentarioDAO.php";
require_once "schema/Post/PostDAO.php";
require_once "schema/Documento/DocumentoDAO.php";
require_once "schema/Idioma/IdiomaDAO.php";
require_once "schema/Menu/MenuDAO.php";
require_once "schema/Audio/AudioDAO.php";
require_once "schema/VideoYT/VideoYTDAO.php";
require_once "schema/VideoVM/VideoVMDAO.php";

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

/** HTML parser */
require_once "simple_html_dom.php";
/** **/