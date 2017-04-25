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

                    $t=60;
                    include DIR_PATH."/includes/panel/templates/posts/save.php";

                    $label="Nombre";
                    $class=array("s12","m6","l6");
                    $model="titulo";
                    include DIR_PATH."/includes/panel/templates/posts/input/text.php";



                    $label="Apellido";

                    $class=array("s12","m6","l6");
                    $model="volanta";
                    include DIR_PATH."/includes/panel/templates/posts/input/text.php";



                    $label="DNI";
                    $class=array("s12","m6","l6");
                    $model="bajada";
                    include DIR_PATH."/includes/panel/templates/posts/input/text.php";



                    $label="Edad";
                    $class=array("s12","m6","l6");
                    $model="texto";
                    include DIR_PATH."/includes/panel/templates/posts/input/text.php";

                    $label="Categoria";
                    $options=["Senior","General","Principiante"];
                    $class=[];
                    include DIR_PATH."/includes/panel/templates/posts/input/select.php";


                    $label="Email";
                    $model="extra1";
                    include DIR_PATH."/includes/panel/templates/posts/input/text.php";


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