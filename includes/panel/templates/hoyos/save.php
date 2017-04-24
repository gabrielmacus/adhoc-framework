
<header>
    <h2><?php echo $lang["hoyosave"]?></h2>
</header>
<script>


    angular.element(function () {

        scope.hoyo={};
        scope.save=function () {


            console.log(scope.hoyo);
        }

    });

</script>


<div class="body">

    <form data-ng-submit="save()">
        <?php
        $label="Número";
        $model="hoyo.titulo";
        include DIR_PATH."/includes/panel/templates/posts/input/number.php";

        $model="hoyo.extra1";
        $id="map1";
        $title ="Marcador";
        include DIR_PATH."/includes/panel/templates/posts/input/map.php";


        $model="hoyo.extra2";
        $id="map2";
        $title="Marcadores";
        include DIR_PATH."/includes/panel/templates/posts/input/map-multiple.php";


        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/posts/input/submit.php";





        ?>

    </form>


</div>
