
<header>
    <h2><?php echo $lang["hoyosave"]?></h2>
</header>
<script>


    angular.element(function () {

        scope.hoyo={};

        <?php if($post)

        {
            ?>
        scope.hoyo = <?php echo json_encode($post);?>;
        <?Php
        }?>
        scope.$apply();

        scope.save=function () {

            $.ajax
            (
                {
                    method:"post",
                    url:"<?php echo $configuracion->getSiteAddress()."/admin/posts/data.php?t={$t}&act=save"?>",
                    data:angular.copy(scope.hoyo),
                    dataType:"json",
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

        $model="hoyo.extra_1";
        $id="map1";
        $title ="Marque la ubicación del hoyo";
        include DIR_PATH."/includes/panel/templates/posts/input/map.php";



        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/posts/input/submit.php";





        ?>

    </form>


</div>
