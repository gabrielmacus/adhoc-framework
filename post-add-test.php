<?php
include "includes/autoload.php";

$post= new Post();

$post->setTexto($_POST["texto"]);

$post->setTitulo($_POST["titulo"]);
$post->setSeccion($_POST["seccion"]);
$post->setEtiquetas($_POST["etiquetas"]);
$post->setVolanta($_POST["volanta"]);
$post->setBajada($_POST["bajada"]);
$post->setExtra1($_POST["extra1"]);
$post->setExtra1($_POST["extra2"]);
$post->setExtra1($_POST["extra3"]);
$post->setExtra1($_POST["extra4"]);




$r  = $repositorioDAO->selectRepositorioById(1);
$archivos=array();
foreach ($_FILES as $file)
{
    $archivoId=$archivoDAO->insertArchivo(new Archivo($file["size"],$file["name"],$file["type"],null,null,$file["tmp_name"],$r));
    $archivos[]=array("archivo_id"=>$archivoId,"archivo_orden"=>0);

}



$post->setArchivos($archivos);

$postDAO->insertPost($post);