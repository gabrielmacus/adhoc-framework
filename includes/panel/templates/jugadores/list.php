
<header>
    <h2><?php echo $lang["jugadores"]?></h2>
</header>


<div class="body">

    <?php
    $title=$lang["jugadoreslistado"];
    foreach ($posts as $post)
    {
        $row["#"]["data"]=$post->getId();
        $row[$lang["nombre"]]["data"]=$post->getTitulo();
        $row[$lang["apellido"]]["data"]=$post->getVolanta();
        $row[$lang["edad"]]["data"]=$post->getExtra1();;
        $row[$lang["dni"]]["data"]=$post->getBajada();


        $rows[]=$row;
    }

    include DIR_PATH."/includes/panel/templates/posts/table.php";
    ?>

</div>
