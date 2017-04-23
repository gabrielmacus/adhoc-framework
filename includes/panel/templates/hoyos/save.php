
<header>
    <h2><?php echo $lang["hoyosave"]?></h2>
</header>
<script>


    angular.element(function () {

        scope.save=function () {

            console.log(scope.hoyo);
        }

    });

</script>


<div class="body">

    <form>
        <?php
        $label="Número";
        $model="hoyo.numero";
        include DIR_PATH."/includes/panel/templates/posts/input/number.php";

        $name="Guardar cambios";
        $action="save()";
        include DIR_PATH."/includes/panel/templates/posts/input/submit.php";
        ?>

    </form>


</div>
