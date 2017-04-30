
<header>
    <h2>Prueba</h2>
</header>

<?php include DIR_PATH."/includes/panel/templates/posts/save.php";?>

<div class="body">

    <form data-ng-submit="save()">
        <?php
        $label="Número";
        $model="titulo";
        include DIR_PATH."/includes/panel/templates/posts/input/number.php";


        $label="Galeria de imágenes";
        $grupo=1;
        $formats=[];//TODO proximamente
        include DIR_PATH."/includes/panel/templates/posts/input/filesadj.php";


        $label="Galeria de imágenes 2";
        $grupo=45;
        $formats=[];//TODO proximamente
        include DIR_PATH."/includes/panel/templates/posts/input/filesadj.php";

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
