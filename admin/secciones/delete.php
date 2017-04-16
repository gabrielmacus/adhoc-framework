<?php

include "../../includes/autoload.php";

include_once DIR_PATH."/extras/api/check-login.php";
try{


    $GLOBALS["seccionDAO"] ->deleteSeccionById($_POST["id"]);

    echo json_encode($_POST);


}catch (Exception $e)
{
}



