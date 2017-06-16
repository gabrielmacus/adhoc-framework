<?php
$title="Portadas";
$mainSeccionFilter=105;//La seccion principal de la lista de secciones que me muestra a filtrar

include DIR_PATH."/includes/panel/templates/gui/titles/header.php";
?>

<div class="body">

    <?php
    $title="Listado de portadas";
    foreach ($posts as $post)
    {

        $row["#"]["data"]=$post->getId();

        $rows[]=$row;
    }

    include DIR_PATH."/includes/panel/templates/gui/table.php";


    $href=$configuracion->getSiteAddress()."/admin/posts/?s={$_GET["s"]}&t={$_GET["t"]}&act=save";
    $title="Nueva entrada";
    include DIR_PATH."/includes/panel/templates/gui/input/add.php";

    include DIR_PATH."/includes/panel/templates/gui/paginador.php";
    ?>

</div>
