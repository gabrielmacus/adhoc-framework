
<header>
    <h2>Prueba</h2>
</header>


<div class="body">

    <form data-ng-submit="save()">
        <?php


        $label="Titulo";
        $model="titulo";
        include DIR_PATH."/includes/panel/templates/gui/input/text.php";



        $label="¿Es un formulario de prueba?";
        $model="extra5";
        $regex=false;
        $items = array(
            "Si"=>10,
            "No"=>"false"
        );
        include DIR_PATH."/includes/panel/templates/gui/input/radio.php";



        $label="Seleccione intereses";
        $model="etiquetas";
        $regex=false;
        $items = array(
            "Programación"=>"10",
            "Maquetación"=>"M",
            "Diseño"=>"D"
        );
        include DIR_PATH."/includes/panel/templates/gui/input/checkbox.php";

        //Chequea el value de cada option
        //Solo es valida la opcion 'Data 1'
        $errorMsg="Seleccione una opción válida";
        $regex='^Data 1$';
        $model ="bajada";
        $label="Nivel";
        $options=array(
            1=>"Data 1",
            2 =>"Data 2",
            3 =>"Data 3"

        );

        include DIR_PATH."/includes/panel/templates/gui/input/select.php";

        $errorMsg="Los telefonos deben contener solo números, y ser mínimo 1, máximo 5";
        $label="Telefonos";
        $model="volanta";
        $id="telefonos1";
        $regex='^[0-9]*$';
        $max=5;
        $min=1;
        include DIR_PATH."/includes/panel/templates/gui/input/tags.php";

/*
        $model="extra2";
        $label="Direcciones";
        $emptyMsg="No hay direcciones cargadas";
        include DIR_PATH."/includes/panel/templates/gui/input/collection.php";
*/

        $max=6;
        $min=3;
        $formats=["jpg"];
        $errorMsg="Debe seleccionar entre {$min} y {$max} archivos";

        $label="Galeria de imágenes";
        $grupo=1;

        include DIR_PATH."/includes/panel/templates/gui/input/filesadj.php";



        $label="Galeria de imágenes 2";
        $grupo=45;
        $formats=[];//TODO proximamente
        include DIR_PATH."/includes/panel/templates/gui/input/filesadj.php";



        $min=0;
        $max=3;
        $label="Posts adjuntos";
        $grupo=26;
        $s="posts";
        $tipo=84;
        $shownText="titulo";
        include DIR_PATH."/includes/panel/templates/gui/input/anexos.php";



        $label="Posts adjuntos 2";
        $grupo=27;
        $s="posts";
        $tipo=84;
        $shownText="titulo";
        include DIR_PATH."/includes/panel/templates/gui/input/anexos.php";




        $label="Texto";
        $id="data";
        $model="texto";
        include DIR_PATH."/includes/panel/templates/gui/input/richtext.php";


        $model="extra1";
        $id="map1";
        $title ="Marque la ubicación del hoyo";
        include DIR_PATH."/includes/panel/templates/gui/input/map.php";


            $model="extra4";
            $id="map2";
            $title ="Marque la ubicación de los hoyos";
            include DIR_PATH."/includes/panel/templates/gui/input/map-multiple.php";


        $successMessage="Noticia guardada correctamente";
        include DIR_PATH."/includes/panel/templates/gui/save.php";

        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/gui/input/submit.php";

        ?>

    </form>


</div>
