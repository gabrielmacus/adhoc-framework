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

                    $label="Nombre";
                    $class="s12 m6 l6";
                    $model="titulo";
                    include DIR_PATH."/includes/panel/templates/input/text.php";



                    $label="Nombre";
                    $class="s12 m6 l6";
                    $model="titulo";
                    include DIR_PATH."/includes/panel/templates/input/text.php";



                    $label="Nombre";
                    $class="s12 m6 l6";
                    $model="titulo";
                    include DIR_PATH."/includes/panel/templates/input/text.php";



                    $label="Nombre";
                    $class="s12 m6 l6";
                    $model="titulo";
                    include DIR_PATH."/includes/panel/templates/input/text.php";
                    ?>

                    <div class="form-block ">
                        <label>Categoria</label>
                        <select>
                            <option>Senior</option>
                            <option>General</option>
                            <option>Principiante</option>

                        </select>
                    </div>
                    <div class="form-block">
                        <label>Email</label>
                        <input>
                    </div>

                    <div class="form-block">
                        <input type="submit" class="animated" value="Aceptar">
                    </div>


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