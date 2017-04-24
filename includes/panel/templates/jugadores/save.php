<?php

include DIR_PATH."/includes/panel/templates/posts/save.php";


?>
    <div class="body">

        <form data-ng-submit="save()">
<?php
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




