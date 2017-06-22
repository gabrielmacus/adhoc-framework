<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 23/04/2017
 * Time: 21:29

 */


include "../../includes/autoload.php";

//include_once DIR_PATH."/extras/api/check-login.php"; TODO agregar usuarios con sus permisos

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{

    $t =$_GET["t"];
    $r=$_GET["r"];
    switch ($_GET["act"])
    {
        case "save":
            
      uploadTmp($r) ;
      
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
            $post->setUsuario($user["id"]);

      var_dump($post);

            if($_POST["creacion"])
      {
          $post->setCreacion($_POST["creacion"]);
      }

            $post->setSeccion($t);
            //$post->setAnexos(array(array("post_anexo_id"=>24)));

            if ($_POST["id"]) {

                $post->setId($_POST["id"]);
                echo json_encode($GLOBALS["postDAO"]->updatePost($post));
            } else {
                echo json_encode($GLOBALS["postDAO"]->insertPost($post));

            }

            break;

        case "delete":
            echo json_encode($GLOBALS["postDAO"]->deletePostById($_GET["id"]));

            break;

    }


}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}




