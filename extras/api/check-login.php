<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 16/04/2017
 * Time: 0:16
 */

include_once "../../includes/autoload.php";

$token = $_GET["usrtk"];

if(empty($token))
{
    $token =$_COOKIE["usrtk"];
}


try
{
    //$GLOBALS["userDAO"]->selectToken("gabrielmacus@gmail.com","sercan02");
    $user=(array)\Firebase\JWT\JWT::decode($token,$configuracion->getTokenSecret(),array('HS512'));
    $user=(array)$user["data"];

    if(isset($asyncLogin))
    {
        echo json_encode($user);
        exit();
    }


}
catch (Exception $e)
{

    if(isset($asyncLogin))
    {
        echo "Login:1";
        exit();
    }

    
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        setcookie("referer",$actual_link,0,"/");

        if(!$redirect)
        {
            $redirect =$configuracion->getSiteAddress()."/admin/login.php";
        }

        header('Location: '.$redirect, true, 302);
        exit();
    
   

}
