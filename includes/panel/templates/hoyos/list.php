
<header>
    <h2><?php echo $lang["hoyos"]?></h2>
</header>

<div class="body">

    <?php
    $title=$lang["hoyoslistado"];
    foreach ($posts as $post)
    {
        $row["#"]["data"]=$post->getId();
        $row[$lang["numero"]]["data"]=$post->getTitulo();
        $row[$lang["posicion"]]["data"]=$lang["verposicion"];
        $row[$lang["posicion"]]["modal"]=true;
        $row[$lang["posicion"]]["href"]= $configuracion->getSiteAddress()."/admin/posts/map.php?modal=true&pos=".str_replace('"',"",$post->getExtra1());


        $rows[]=$row;
    }
    include DIR_PATH."/includes/panel/templates/posts/table.php";
    ?>

</div>
