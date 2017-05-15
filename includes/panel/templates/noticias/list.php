
<header>
    <h2><?php echo $lang["jugadores"]?></h2>
</header>


<div class="body">

    <?php
    $title=$lang["jugadoreslistado"];
    foreach ($posts as $post)
    {

        $row["#"]["data"]=$post->getId();
        $row["Titulo"]["data"]=$post->getTitulo();
        $row["Volanta"]["data"]=$post->getVolanta();



        $rows[]=$row;
    }

    include DIR_PATH."/includes/panel/templates/posts/table.php";
    ?>

</div>
