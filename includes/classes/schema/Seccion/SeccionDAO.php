<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 23:15
 */

require_once ("ISeccion.php");
require_once ("Seccion.php");


class SeccionDAO
{

    protected $dataSource;
    protected $tableName;
    protected $secciones=array();
    private $insertSql;
    private $updateSql;

    /**
     * UserDAO constructor.
     * @param $dataSource
     * @param $tableName
     */
    public function __construct(DataSource $dataSource, $tableName="secciones")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;
        $this->insertSql="INSERT INTO  {$this->tableName} 
 (seccion_id,seccion_nombre,seccion_tipo)
 VALUES (:seccion_id,:seccion_nombre,:seccion_tipo)";

        $this->updateSql="UPDATE {$this->tableName}  SET seccion_id=:seccion_id,seccion_nombre=:seccion_nombre
,seccion_tipo=:seccion_tipo WHERE seccion_id=:seccion_id";

    }



    public function insertSeccion(Seccion $s)
    {
        $this->validate($s);

        $sql = $this->insertSql;

        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($s));
        return $res;
    }

    private function getParamsArray(Seccion $s)
    {
        return    array(
            ":seccion_id"=>$s->getId(),
            ":seccion_nombre"=>$s->getNombre(),
            ":seccion_tipo"=>$s->getTipo()
        );
    }
    private function query($data)
    {
        $s=new Seccion();
        $s->setId($data["seccion_id"]);
        $s->setNombre($data["seccion_nombre"]);
        $s->setTipo($data["seccion_tipo"]);
        array_push($this->users, $s);

    }



    public function selectSecciones()
    {
        $sql = "SELECT * FROM {$this->tableName}";

        $this->dataSource->runQuery($sql,array(),function($data){

            $this->query($data);

        });

        return $this->secciones[0];
    }

    public function selectSeccionById($id)
    {

        $sql = "SELECT * FROM {$this->tableName} WHERE seccion_id=:seccion_id";

        $this->dataSource->runQuery($sql,array(":seccion_id"=>$id),function($data){
            $this->query($data);
        });

        return $this->secciones[0];
    }

    public function updateSeccion(Seccion $s)
    {
        $this->validate($s);

        $sql = $this->updateSql;
        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($s));
        return $res;
    }

    public function deleteSeccionById($id)
    {

        $sql = "DELETE FROM {$this->tableName} WHERE seccion_id= :seccion_id";

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":seccion_id"=>$id
            ));
        return $res;
    }

    public function validate(Seccion $s)
    {
        // TODO: Implement validate() method.
    }


}