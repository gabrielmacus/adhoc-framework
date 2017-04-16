<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 16/04/2017
 * Time: 2:39
 */

include_once "../includes/autoload.php";

setcookie("usrtk", "", time()-3600);

$redirect =$configuracion->getSiteAddress()."/admin/login.php";

header('Location: '.$redirect);