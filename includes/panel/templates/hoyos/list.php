
<header>
    <h2><?php echo $lang["hoyos"]?></h2>
</header>
<script>


    angular.element(function () {

        scope.hoyos = <?php echo json_encode($posts)?>;

        console.log(scope.hoyos);
        scope.$apply();

    });

</script>

<div class="body">

    <?php
    $title=$lang["hoyoslistado"];
    foreach ($posts as $post)
    {
        $row[$lang["numero"]]["data"]=$post->getTitulo();
        $row[$lang["posicion"]]["data"]=$post->getExtra1();


        $rows[]=$row;
    }
    include DIR_PATH."/includes/panel/templates/posts/table.php";
    ?>

</div>
