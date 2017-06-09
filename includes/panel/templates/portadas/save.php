
<header>
    <h2>Organización de la portada</h2>
</header>


<div class="body">

    <form data-ng-submit="save()">
        <?php

        include DIR_PATH."/includes/panel/templates/gui/input/secciones.php";


        $label="Titulo";
        $model="titulo";
        include DIR_PATH."/includes/panel/templates/gui/input/text.php";

        $label="Bajada";
        $model="bajada";
        include DIR_PATH."/includes/panel/templates/gui/input/textarea.php";


        $label="Galeria multimedia (imágenes,videos,audios,etc...)";
        $grupo=1;
        $formats=[];//TODO proximamente
        include DIR_PATH."/includes/panel/templates/gui/input/filesadj.php";


        $label="Notas relacionadas";
        $grupo=2;
        $s="posts";
        $tipo=84;
        $shownText="titulo";
        include DIR_PATH."/includes/panel/templates/gui/input/anexos.php";


        $label="Texto";
        $id="data";
        $model="texto";
        include DIR_PATH."/includes/panel/templates/gui/input/richtext.php";


        $model="extra2";
        $id="map1";
        $title ="Ubicación (opcional)";
        include DIR_PATH."/includes/panel/templates/gui/input/map.php";



        $successMessage="Noticia guardada correctamente";
        include DIR_PATH."/includes/panel/templates/gui/save.php";

        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/gui/input/submit.php";

        ?>

    </form>


</div>
