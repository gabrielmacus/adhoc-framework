
<header>
    <h2>Prueba</h2>
</header>


<div class="body">

    <form data-ng-submit="save()">
        <?php

        include DIR_PATH."/includes/panel/templates/gui/input/secciones.php";


        $label="Titulo";
        $model="titulo";
        $errorMsg="Ingrese el título correctamente";
        //Cualquier caracter, min 5 , max 90
        $regex='^.{5,90}$';
        include DIR_PATH."/includes/panel/templates/gui/input/text.php";

        $label="Bajada";
        $model="bajada";
        include DIR_PATH."/includes/panel/templates/gui/input/textarea.php";


       
        $successMessage="Noticia guardada correctamente";
        include DIR_PATH."/includes/panel/templates/gui/save.php";

        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/gui/input/submit.php";

        ?>

    </form>


</div>
