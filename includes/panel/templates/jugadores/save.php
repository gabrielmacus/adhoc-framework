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
$model="extra_1";
include DIR_PATH."/includes/panel/templates/posts/input/text.php";

$label="DNI";
$model="bajada";
include DIR_PATH."/includes/panel/templates/posts/input/text.php";

$name="Guardar cambios";
include DIR_PATH."/includes/panel/templates/posts/input/submit.php";?>

        </form>

    </div>




