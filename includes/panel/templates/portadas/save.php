
<header>
    <h2>Organización de la portada</h2>
</header>


<div class="body">

    <form data-ng-submit="save()">
        <?php


        $label="Notas destacadas";
        $grupo=1;
        $s="noticias";
        $tipo="108,103";
        $shownText="titulo";
        include DIR_PATH."/includes/panel/templates/gui/input/anexos.php";


        $successMessage="Noticia guardada correctamente";
        include DIR_PATH."/includes/panel/templates/gui/save.php";

        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/gui/input/submit.php";

        ?>

    </form>


</div>
