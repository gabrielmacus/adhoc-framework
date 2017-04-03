<?php

include "../../includes/autoload.php";

try{


    $GLOBALS["seccionDAO"] ->deleteSeccionById($_POST["id"]);

    echo json_encode($_POST);


}catch (Exception $e)
{
}



