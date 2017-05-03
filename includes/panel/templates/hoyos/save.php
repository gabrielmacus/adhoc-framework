
<header>
    <h2><?php echo $lang["hoyosave"]?></h2>
</header>

<?php include DIR_PATH."/includes/panel/templates/posts/save.php";?>

<div class="body">

    <form data-ng-submit="save()">
        <?php
        $label="Número";
        $model="titulo";
        include DIR_PATH."/includes/panel/templates/posts/input/number.php";

        $model="extra4";
        $id="map1";
        $title ="Marque la ubicación del hoyo";
        include DIR_PATH."/includes/panel/templates/posts/input/map-multiple.php";


        /*

        $model="extra4";
        $id="map5";
        $title ="Marque la ubicación del sapo";
        include DIR_PATH."/includes/panel/templates/posts/input/map-multiple.php";
*/

        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/posts/input/submit.php";





        ?>

    </form>


</div>
