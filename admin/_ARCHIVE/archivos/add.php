<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 03/04/2017
 * Time: 1:07
 */

include "../../includes/autoload.php";

include_once DIR_PATH."/extras/api/check-login.php";

try{

    $rep=$_GET["rep"];

    if(!is_numeric($rep) || !$rep)
    {
       $res= "El repositorio no es correcto";//TODO pasar $lang a objeto
    }

    if(!(count($_POST["files"])>0))
    {
        $res="No se seleccionó ningún archivo para subir";
    }
    
    if(!$res)
    {
        foreach ($_POST["previews"] as $file)
        {

            $file["tmp"]=DIR_PATH.$file["tmp"];


            switch ($file["type"])
            {
                default:
                    
                    $a = new Archivo($file["size"],$file["name"],$file["mime"]);
                    $a->setTmpPath($file["tmp"]);
                    $a->setExtension($file["type"]);
                    $a->setRepositorio($rep);
                    $res= $GLOBALS["archivoDAO"]->insertArchivo($a);

                    break;


                case "svg":
                case "jpeg":
                case "bmp":
                case "png":
                case "gif":
                case "jpg":


                    $a = new Imagen($file["size"],$file["name"],$file["mime"]);
                    $a->setTmpPath($file["tmp"]);
                    $a->setExtension($file["type"]);
                    $a->setRepositorio($rep);

                    $res= $GLOBALS["imagenDAO"]->insertArchivo($a);
                    break;

            }

        }
    }
    

    echo json_encode($res);

}
catch (Exception $e)
{

    var_dump($e);
    echo "Error: {$e->getMessage()}";

}

