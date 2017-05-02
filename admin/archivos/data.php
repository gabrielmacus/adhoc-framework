<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 03/04/2017
 * Time: 1:07
 */


include "../../includes/autoload.php";

//include_once DIR_PATH."/extras/api/check-login.php"; TODO agregar usuarios con sus permisos

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{


    //$post->setAnexos(array(array("post_anexo_id"=>24)));

    switch ($_GET["act"])
    {
        case "save":


            echo  json_encode(uploadTmp($_GET["rep"]));

            break;
        case "upload":

            $tmps=array();

            foreach ($_FILES as $file)
            {

                $dest=DIR_PATH."/tmp/files/{$file["size"]}_{$file["name"]}";

                copy($file["tmp_name"],$dest);

                $tmp="/tmp/files/{$file["size"]}_{$file["name"]}";
                $dest=$configuracion->getSiteAddress().$tmp;

                $ext = explode(".",$file["name"]);
                $ext = end($ext);
              
                array_push($tmps,
                    array("url"=>$dest,"name"=>$file["name"],"size"=>$file["size"],"type"=>$ext,"mime"=>$file["type"],"tmp"=>$tmp));

            }
            echo  json_encode($tmps);

            break;

        case "delete":



          foreach ($_POST["files"] as $file)
          {
              var_dump($file["archivo_id"]);
           //   $GLOBALS["archivoDAO"]->deleteArchivoById($file["archivo_id"]);
          }

              echo json_encode(true);
            break;
    }



}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}