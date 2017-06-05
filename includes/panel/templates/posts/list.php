<?php
$title="Lista de elementos";
include DIR_PATH."/includes/panel/templates/gui/titles/header.php";
?>

<div class="body">

    <?php
    $title="Listado de posts";
    foreach ($posts as $post)
    {

    $row["#"]["data"]=$post->getId();
        $row["Titulo"]["data"]=$post->getTitulo();
        $row["Volanta"]["data"]=$post->getVolanta();


s
        $rows[]=$row;
    }

    include DIR_PATH."/includes/panel/templates/gui/table.php";
    $href="/admin/posts/?s=posts&t={$_GET["s"]}";
    $title="Nueva entrada";
    include DIR_PATH."/includes/panel/templates/gui/input/add.php";
    ?>


</div>
