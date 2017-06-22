
<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 29/03/2017
 * Time: 1:32
 */


require_once ("Video.php");

class VideoDAO extends ArchivoDAO
{
    public function __construct(DataSource $dataSource, $tableName = "archivos")
    {
        parent::__construct($dataSource, $tableName);
    }


    


}