
<header>
    <h2><?php echo $lang["hoyosave"]?></h2>
</header>
<script>


    angular.element(function () {

        scope.hoyo={};
        scope.save=function () {

            $.ajax
            (
                {
                    method:"post",
                    url:"<?php echo $configuracion->getSiteAddress()."/posts/?t={$t}&s={$site}&act=save&async=true"?>,
                    data:angular.copy(scope.hoyo),
                    success:function (e) {
                        console.log(e);
                    },
                    error:function (e) {

                        console.log(e);
                    }
                }
            )

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
        $title ="Marque la ubicación del hoyo";
        include DIR_PATH."/includes/panel/templates/posts/input/map.php";



        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/posts/input/submit.php";





        ?>

    </form>


</div>
