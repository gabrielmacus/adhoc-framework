<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 12:22 PM
 */
include "includes/autoload.php";

$fbUrl=getLoginUrlFB($GLOBALS["fbConfig"], $configuracion->getSiteAddress()."/fb-callback.php");

echo "<a href='{$fbUrl}'>Login with FB</a>";
/*
$fb = new Facebook\Facebook([
    'app_id' => $GLOBALS["fbConfig"]["app_id"], // Replace {app-id} with your app id
    'app_secret' => $GLOBALS["fbConfig"]["app_secret"],
    'default_graph_version' => $GLOBALS["fbConfig"]["default_graph_version"],
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email','publish_actions']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/adhoc-framework/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';*/