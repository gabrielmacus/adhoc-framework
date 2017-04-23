<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 16/04/2017
 * Time: 0:16
 */

include_once "../../includes/autoload.php";

$token = $_GET["usrtk"];

if(!$token)
{
    $token =$_COOKIE["usrtk"];
}


try
{
    //$GLOBALS["userDAO"]->selectToken("gabrielmacus@gmail.com","sercan02");
    $user=(array)\Firebase\JWT\JWT::decode($token,$configuracion->getTokenSecret(),array('HS512'));
    $user=(array)$user["data"];
}
catch (Exception $e)
{
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    setcookie("lastUrl",$actual_link);

    if(!$redirect)
    {
        $redirect =$configuracion->getSiteAddress()."/admin/login.php";
    }

    header('Location: '.$redirect, true, 302);

}
