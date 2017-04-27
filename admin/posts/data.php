<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 23/04/2017
 * Time: 21:29

 */


include "../../includes/autoload.php";

include_once DIR_PATH."/extras/api/check-login.php";

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{

    $t =$_GET["t"];
    $r=31;
    switch ($_GET["act"])
    {
        case "save":


            $previews=array();
            foreach ($_POST["previews"] as $file)//Para subida de archivos directa
            {

                $file["tmp"]=DIR_PATH.$file["tmp"];


                switch ($file["type"])
                {
                    default:


                        $a = new Archivo($file["size"],$file["name"],$file["mime"]);

                        $a->setTmpPath($file["tmp"]);
                        $a->setExtension($file["type"]);
                        $a->setRepositorio($r);
                        $res= $GLOBALS["archivoDAO"]->insertArchivo($a);
                        $previews[]=$res[0];
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
                        $a->setRepositorio($r);


                        $res= $GLOBALS["imagenDAO"]->insertArchivo($a);
                    $previews[]=$res[0];
                        break;

                }

            }
            echo json_encode($previews);
            exit();
           // $a =new ArchivoDAO();
            //$a->selectArchivoById(,false);

            $post = new Post();
            $post->setTitulo($_POST["titulo"]);
            $post->setTexto($_POST["texto"]);
            $post->setArchivos($_POST["archivos"]);
            $post->setSeccion($_POST["seccion"]);
            $post->setBajada($_POST["bajada"]);
            $post->setVolanta($_POST["volanta"]);
            $post->setExtra1($_POST["extra1"]);
            $post->setExtra2($_POST["extra2"]);
            $post->setExtra3($_POST["extra3"]);
            $post->setExtra4($_POST["extra4"]);
            $post->setAnexos($_POST["anexos"]);
            $post->setSeccion($t);
            //$post->setAnexos(array(array("post_anexo_id"=>24)));

            if ($_POST["id"]) {

                $post->setId($_POST["id"]);
                echo json_encode($GLOBALS["postDAO"]->updatePost($post));
            } else {
                echo json_encode($GLOBALS["postDAO"]->insertPost($post));

            }

            break;


    }


}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}




