<?php

include DIR_PATH."/includes/panel/templates/posts/save.php";


?>

<header>
    <h2><?php echo $lang["jugadorsave"]?></h2>
</header>

    <div class="body">

        <form data-ng-submit="save()">
<?php

$label="Foto de perfil";
$grupo=0;
$formats=[];//TODO proximamente
include DIR_PATH."/includes/panel/templates/posts/input/filesadj.php";



$label="Nombre";
$model="titulo";
include DIR_PATH."/includes/panel/templates/posts/input/text.php";

$label="Apellido";
$model="volanta";
include DIR_PATH."/includes/panel/templates/posts/input/text.php";

$label="Edad";
$model="extra1";
include DIR_PATH."/includes/panel/templates/posts/input/number.php";

$label="DNI";
$model="bajada";
include DIR_PATH."/includes/panel/templates/posts/input/number.php";

$name="Guardar cambios";
include DIR_PATH."/includes/panel/templates/posts/input/submit.php";?>

        </form>

    </div>




