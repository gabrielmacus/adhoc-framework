<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 12:22 PM
 */
include "includes/autoload.php";

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{


$fb = new \Facebook\Facebook($GLOBALS["fbConfig"]);

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes']; // optional
    $loginUrl = $helper->getLoginUrl("http://{$configuracion->getSiteAddress()}/login-callback.php", $permissions);

    $a='<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

include DIR_PATH."/includes/templates/comun/estructura.php";
