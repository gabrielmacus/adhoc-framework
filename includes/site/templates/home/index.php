<div class="overlay">

</div>
<div class="overlay-2">

</div>
<div class="body">



        <div class="player-form-container animated bounceIn" >

            <div class="fila">
                <div class="form-title">
                    <h2>Completa con tus datos</h2>
                </div>
            </div>


            <div class="fila">
                <form class="player-form shadow">


                    <?php

                    $t=61;
                    $subsecciones =    $GLOBALS["seccionDAO"]->selectSeccionesByTipo($t);



                    $successMessage="Se inscribió correctamente. Chequee su email para confirmar la inscripción";
                    include DIR_PATH."/includes/panel/templates/posts/save.php";



                    $formats=["jpg","jpeg","png"];
                    $view=DIR_PATH."/includes/site/templates/home/preview-single-pic.php";;
                    $label="Foto";
                    $uploadMessage="Arrastrá tu foto de perfil o presioná acá";
                    $max=1;
                    $id="foto";
                    include DIR_PATH."/includes/panel/templates/posts/input/files.php";

                    $label="Nombre";
                    $class=array("s12","m6","l6");
                    $model="titulo";
                    $max=60;
                    include DIR_PATH."/includes/panel/templates/posts/input/text.php";


                    $label="Apellido";
                    $class=array("s12","m6","l6");
                    $model="volanta";
                    $max=60;
                    include DIR_PATH."/includes/panel/templates/posts/input/text.php";


                    $label="DNI";
                    $class=array("s12","m6","l6");
                    $model="bajada";
                    $max=9;
                    include DIR_PATH."/includes/panel/templates/posts/input/text.php";


                    $label="Edad";
                    $class=array("s12","m6","l6");
                    $model="extra1";
                    $max=100;
                    include DIR_PATH."/includes/panel/templates/posts/input/number.php";

                    $label="Categoria";
                    foreach ($subsecciones as $seccion)
                    {
                        $options=array(
                          $seccion->getId()=>$seccion->getNombre()
                        );
                    }

                    $model="extra2";
                    $class=[];
                    include DIR_PATH."/includes/panel/templates/posts/input/select.php";


                    $label="Email";
                    $model="extra3";
                    $max=60;
                    include DIR_PATH."/includes/panel/templates/posts/input/email.php";


                  $name="Aceptar";
                  $action="save()";
                  include DIR_PATH."/includes/panel/templates/posts/input/submit.php";
                  ?>


                </form>
            </div>

        </div>


</div>

<script>
$(document).ready(function () {
    $(".overlay-2").vegas({
        transition:"blur",
        slides: [
            { src: "http://hondusports.com/wp-content/uploads/2016/09/Futgolf-Honduras-Indura-e1472798015817.jpg" },
            { src:"http://www.hiseman.com/ahimages/Sunbury_FootGolf_300dpi_02_full.jpg"}
        ]
    });
});
</script>