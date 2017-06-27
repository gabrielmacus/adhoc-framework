<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 23/04/2017
 * Time: 21:29

 */


include "../../includes/autoload.php";
if(!isset($_GET["async"]))
{
    include_once DIR_PATH."/extras/api/check-login.php"; //TODO agregar usuarios con sus permisos
}


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

            $usuario = new User();
            $usuario->setAge($_POST["age"]);
            $usuario->setEmail($_POST["email"]);
             $usuario->setName($_POST["name"]);
      $usuario->setNickname($_POST["nickname"]);
      $usuario->setSurname($_POST["surname"]);
      $usuario->setStatus($_POST["status"]);
      $usuario->setPost($_POST["post"]);


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




