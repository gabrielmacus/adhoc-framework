<?php

include "../../includes/autoload.php";

try{
    $s = new Seccion();

    $s->setNombre($_POST["nombre"]);
    $s->setTipo($_POST["tipo"]);
 $_POST["id"]=($GLOBALS["seccionDAO"] ->insertSeccion($s));

    echo json_encode($_POST);


}catch (Exception $e)
{
}



