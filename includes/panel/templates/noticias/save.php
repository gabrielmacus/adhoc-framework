
<header>
    <h2>Prueba</h2>
</header>


<div class="body">

    <form data-ng-submit="save()">
        <?php

        $label="Titulo";
        $model="titulo";
        include DIR_PATH."/includes/panel/templates/posts/input/text.php";


        $model ="bajada";
        $label="Nivel";
        $options=array(
            1=>"Data 1",
            2 =>"Data 2",
            3 =>"Data 3"

        );
        include DIR_PATH."/includes/panel/templates/posts/input/select.php";

        $label="Telefonos";
        $model="volanta";
        $id="telefonos1";

        include DIR_PATH."/includes/panel/templates/posts/input/tags.php";

/*
        $model="extra2";
        $label="Direcciones";
        $emptyMsg="No hay direcciones cargadas";
        include DIR_PATH."/includes/panel/templates/posts/input/collection.php";
*/

        $label="Galeria de imágenes";
        $grupo=1;
        $formats=[];//TODO proximamente
        include DIR_PATH."/includes/panel/templates/posts/input/filesadj.php";


        $label="Galeria de imágenes 2";
        $grupo=45;
        $formats=[];//TODO proximamente
        include DIR_PATH."/includes/panel/templates/posts/input/filesadj.php";


        $label="Jugadores adjuntos";
        $grupo=25;
        $s="jugadores";
        $tipo=62;
        $shownText=["titulo","volanta"];
        include DIR_PATH."/includes/panel/templates/posts/input/anexos.php";


        $label="Hoyos adjuntos";
        $grupo=26;
        $s="hoyos";
        $tipo=60;
        $shownText="titulo";
        include DIR_PATH."/includes/panel/templates/posts/input/anexos.php";

        $label="Texto";
        $id="data";
        $model="texto";
        include DIR_PATH."/includes/panel/templates/posts/input/richtext.php";


        $model="extra1";
        $id="map1";
        $title ="Marque la ubicación del hoyo";
        include DIR_PATH."/includes/panel/templates/posts/input/map.php";


            $model="extra4";
            $id="map2";
            $title ="Marque la ubicación de los hoyos";
            include DIR_PATH."/includes/panel/templates/posts/input/map-multiple.php";


        $successMessage="Noticia guardada correctamente";
        include DIR_PATH."/includes/panel/templates/posts/save.php";

        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/posts/input/submit.php";

        ?>

    </form>


</div>
