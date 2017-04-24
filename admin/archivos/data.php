<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 03/04/2017
 * Time: 1:07
 */


include "../../includes/autoload.php";

include_once DIR_PATH."/extras/api/check-login.php";

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{


    //$post->setAnexos(array(array("post_anexo_id"=>24)));

    switch ($_GET["act"])
    {
        case "save":

            break;
        case "upload":

            $tmps=array();

            foreach ($_FILES as $file)
            {

                $dest=DIR_PATH."/tmp/files/{$file["size"]}_{$file["name"]}";

                echo json_encode($dest);
                exit();
                move_uploaded_file($file["tmp_name"],$dest);


                $tmp="/tmp/files/{$file["size"]}_{$file["name"]}";
                $dest=$configuracion->getSiteAddress().$tmp;

                $ext = explode(".",$file["name"]);
                $ext = end($ext);
                array_push($tmps,
                    array("url"=>$dest,"name"=>$file["name"],"size"=>$file["size"],"type"=>$ext,"mime"=>$file["type"],"tmp"=>$tmp));

            }
            echo  json_encode($tmps);

            break;
    }



}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}