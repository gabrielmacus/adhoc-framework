<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 03/04/2017
 * Time: 1:07
 */

include "../../includes/autoload.php";

include_once DIR_PATH."/extras/api/check-login.php";

try{
    switch ($_GET["act"])
    {
        case "save":

            if(!is_numeric($_POST["id"]))
            {
                $r = new Repositorio($_POST["host"],$_POST["usuario"],$_POST["pass"],$_POST["nombre"],$_POST["ruta"],$_POST["puerto"]);

                
                $r->setUrl($_POST["url"]);
               echo json_encode( $GLOBALS["repositorioDAO"]->insertRepositorio($r));
            }
            else

            {
                $r = new Repositorio($_POST["host"],$_POST["usuario"],$_POST["pass"],$_POST["nombre"],$_POST["ruta"],$_POST["puerto"],$_POST["creation"],$_POST["modification"],$_POST["id"]);
                $r->setUrl($_POST["url"]);
                echo json_encode($GLOBALS["repositorioDAO"]->updateRepositorio($r));


            }

            break;
    }





}
catch (Exception $e)
{

    var_dump($e);
    echo "Error: {$e->getMessage()}";

}

