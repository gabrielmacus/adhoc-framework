
<header>
    <h2>Prueba</h2>
</header>


<div class="body">

    <form data-ng-submit="save()">
        <?php
        $label="Titulo";
        $model="titulo";

        include DIR_PATH."/includes/panel/templates/posts/input/text.php";

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

        include DIR_PATH."/includes/panel/templates/posts/save.php";

        /*

        $model="extra4";
        $id="map5";
        $title ="Marque la ubicación del sapo";
        include DIR_PATH."/includes/panel/templates/posts/input/map-multiple.php";
*/





        ?>

    </form>


</div>
