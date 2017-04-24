
<header>
    <h2><?php echo $lang["hoyosave"]?></h2>
</header>
<script>


    angular.element(function () {

        scope.post={};

        <?php if($post)

        {
            ?>
        scope.post = <?php echo json_encode($post);?>;
        <?Php
        }?>
        scope.$apply();
        console.log(scope.post);

        scope.save=function () {

            $.ajax
            (
                {
                    method:"post",
                    url:"<?php echo $configuracion->getSiteAddress()."/admin/posts/data.php?t={$t}&act=save"?>",
                    data:angular.copy(scope.post),
                    dataType:"json",
                    success:function (e) {
                        console.log(e);
                    },
                    error:function (e) {

                        console.log(e);
                    }
                }
            )

            console.log(scope.post);
        }

    });

</script>


<div class="body">

    <form data-ng-submit="save()">
        <?php
        $label="Número";
        $model="titulo";
        include DIR_PATH."/includes/panel/templates/posts/input/number.php";

        $model="extra_1";
        $id="map1";
        $title ="Marque la ubicación del hoyo";
        include DIR_PATH."/includes/panel/templates/posts/input/map.php";



        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/posts/input/submit.php";





        ?>

    </form>


</div>
