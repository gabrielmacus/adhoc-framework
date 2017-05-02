<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 01/05/2017
 * Time: 19:54
 */

require_once ("Documento.php");

class DocumentoDAO extends ArchivoDAO
{
    public function __construct(DataSource $dataSource, $tableName = "archivos")
    {
        parent::__construct($dataSource, $tableName);
    }

}