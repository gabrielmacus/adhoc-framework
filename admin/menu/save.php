<?php

include "../../includes/autoload.php";

try{
    $dir=DIR_PATH."/includes/lang/{$configuracion->getLanguage()}.json";
    $menu = json_decode(file_get_contents($dir),true);

    $menu["sidenav"]=$_POST["sidenav"];

    echo json_encode(file_put_contents($dir,json_encode($menu)));

}catch (Exception $e)
{
}



