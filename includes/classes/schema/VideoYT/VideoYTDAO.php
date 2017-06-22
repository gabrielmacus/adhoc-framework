
<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 29/03/2017
 * Time: 1:32
 */


require_once ("VideoYT.php");

class VideoYTDAO extends ArchivoDAO
{
    public function __construct(DataSource $dataSource, $tableName = "archivos")
    {
        parent::__construct($dataSource, $tableName);
    }

    public function insertArchivo(Archivo $a, $versionName = "original", $versionId = 0, $mainPath = false)
    {
        $this->validate($a);

        $a->setVersion($versionId);
        $a->setVersionName($versionName);
        $now = time();
        $a->setCreation($now);
        $a->setModification($now);

        $sql = parent::getInsertSql();


       return  $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($a));
    }

    public function deleteArchivoById($ids)
    {
        $ids = implode(",",$ids);

        $sql ="DELETE FROM archivos WHERE archivo_id IN ({$ids})";

        return $this->dataSource->runUpdate($sql);

    }


}