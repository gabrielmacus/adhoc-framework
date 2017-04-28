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


                    $successMessage="Se inscribió correctamente!";
                    include DIR_PATH."/includes/panel/templates/posts/save.php";
                    $formats=["jpg","jpeg","png"];
                    $view=DIR_PATH."/includes/site/templates/home/preview-single-pic.php";
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

                    $options=array();
                    foreach ($subsecciones as $seccion)
                    {

                        $options[$seccion->getId()]=$seccion->getNombre();
                    }

                    $model="seccion";
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


<style>.sk-circle {
        margin: 15% auto;
        width: 160px;
        height: 160px;
        position: relative;
    }
    .sk-circle .sk-child {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
    }
    .sk-circle .sk-child:before {
        content: '';
        display: block;
        margin: 0 auto;
        width: 15%;
        height: 15%;
        background: linear-gradient(141deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
        border-radius: 100%;
        -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
        animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
    }
    .sk-circle .sk-circle2 {
        -webkit-transform: rotate(30deg);
        -ms-transform: rotate(30deg);
        transform: rotate(30deg); }
    .sk-circle .sk-circle3 {
        -webkit-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
        transform: rotate(60deg); }
    .sk-circle .sk-circle4 {
        -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg); }
    .sk-circle .sk-circle5 {
        -webkit-transform: rotate(120deg);
        -ms-transform: rotate(120deg);
        transform: rotate(120deg); }
    .sk-circle .sk-circle6 {
        -webkit-transform: rotate(150deg);
        -ms-transform: rotate(150deg);
        transform: rotate(150deg); }
    .sk-circle .sk-circle7 {
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg); }
    .sk-circle .sk-circle8 {
        -webkit-transform: rotate(210deg);
        -ms-transform: rotate(210deg);
        transform: rotate(210deg); }
    .sk-circle .sk-circle9 {
        -webkit-transform: rotate(240deg);
        -ms-transform: rotate(240deg);
        transform: rotate(240deg); }
    .sk-circle .sk-circle10 {
        -webkit-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        transform: rotate(270deg); }
    .sk-circle .sk-circle11 {
        -webkit-transform: rotate(300deg);
        -ms-transform: rotate(300deg);
        transform: rotate(300deg); }
    .sk-circle .sk-circle12 {
        -webkit-transform: rotate(330deg);
        -ms-transform: rotate(330deg);
        transform: rotate(330deg); }
    .sk-circle .sk-circle2:before {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s; }
    .sk-circle .sk-circle3:before {
        -webkit-animation-delay: -1s;
        animation-delay: -1s; }
    .sk-circle .sk-circle4:before {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s; }
    .sk-circle .sk-circle5:before {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s; }
    .sk-circle .sk-circle6:before {
        -webkit-animation-delay: -0.7s;
        animation-delay: -0.7s; }
    .sk-circle .sk-circle7:before {
        -webkit-animation-delay: -0.6s;
        animation-delay: -0.6s; }
    .sk-circle .sk-circle8:before {
        -webkit-animation-delay: -0.5s;
        animation-delay: -0.5s; }
    .sk-circle .sk-circle9:before {
        -webkit-animation-delay: -0.4s;
        animation-delay: -0.4s; }
    .sk-circle .sk-circle10:before {
        -webkit-animation-delay: -0.3s;
        animation-delay: -0.3s; }
    .sk-circle .sk-circle11:before {
        -webkit-animation-delay: -0.2s;
        animation-delay: -0.2s; }
    .sk-circle .sk-circle12:before {
        -webkit-animation-delay: -0.1s;
        animation-delay: -0.1s; }

    @-webkit-keyframes sk-circleBounceDelay {
        0%, 80%, 100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        } 40% {
              -webkit-transform: scale(1);
              transform: scale(1);
          }
    }

    @keyframes sk-circleBounceDelay {
        0%, 80%, 100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        } 40% {
              -webkit-transform: scale(1);
              transform: scale(1);
          }
    }

    .loader
    {
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: 20000;
        background-color: rgba(16,16,18,0.39);
    }
</style>

<div class="loader">
    <div class="sk-circle">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
    </div>
</div>