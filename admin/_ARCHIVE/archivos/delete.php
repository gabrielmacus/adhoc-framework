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

    $res=array();

  foreach ($_POST["files"] as $id)
  {
      $res[]=$GLOBALS["archivoDAO"]->deleteArchivoById($id);
  }
   echo json_encode($res);


}
catch (Exception $e)
{

    var_dump($e);
    echo "Error: {$e->getMessage()}";

}

