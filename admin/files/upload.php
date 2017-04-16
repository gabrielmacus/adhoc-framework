<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 04/04/2017
 * Time: 01:30 PM
 */
include "../../includes/autoload.php";

include_once DIR_PATH."/extras/api/check-login.php";

$tmps=array();

foreach ($_FILES as $file)
{

    $dest=DIR_PATH."/tmp/files/{$file["size"]}_{$file["name"]}";

    move_uploaded_file($file["tmp_name"],$dest);

    $tmp="/tmp/files/{$file["size"]}_{$file["name"]}";
    $dest=$configuracion->getSiteAddress().$tmp;

$ext = explode(".",$file["name"]);
$ext = end($ext);
    array_push($tmps,
        array("url"=>$dest,"name"=>$file["name"],"size"=>$file["size"],"type"=>$ext,"mime"=>$file["type"],"tmp"=>$tmp));

}
echo  json_encode($tmps);