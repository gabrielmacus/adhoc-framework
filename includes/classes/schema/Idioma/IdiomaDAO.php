<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 23:15
 */

require_once ("IIdioma.php");
require_once ("Idioma.php");


class IdiomaDAO implements IIdioma
{

    protected $dataSource;
    protected $tableName;
    protected $idiomas=array();
    private $insertSql;
    private $updateSql;
    

    /**
     * IdiomaDAO constructor.
     * @param $dataSource
     * @param $tableName
     * @param array $idiomas
     * @param $insertSql
     * @param $updateSql
     */
    public function __construct($dataSource, $tableName="idiomas")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;
        $this->insertSql="INSERT INTO idiomas (idioma_id,idioma_short,idioma_name,idioma_predeterminado) 
          VALUES  (:idioma_id,:idioma_short,:idioma_name,:idioma_predeterminado) ";

        $this->updateSql="UPDATE FROM idiomas SET idioma_id=:idioma_id,idioma_short=:idioma_short,
idioma_name=:idioma_name,idioma_predeterminado=:idioma_predeterminado  WHERE idioma_id=:idioma_id";
    }

    
     
    public function insertIdioma(Idioma $i)
    {

        $this->validate($i);

        $sql = $this->insertSql;

        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($i));
        return $res;
    }

    private function getParamsArray(Idioma $i)
    {
        return    array(
            ":idioma_id"=>$i->getId(),
            ":idioma_name"=>$i->getNombre(),
            ":idioma_short"=>$i->getShort(),
            ":idioma_predeterminado"=>$i->isPredeterminado()
        );
    }


    public function selectIdiomas()
    {
        $sql = "SELECT * FROM {$this->tableName} ";
        $this->idiomas=array();
        $this->dataSource->runQuery($sql,array(),function($data){


            $this->query($data);

        });

        return $this->idiomas;
    }

    private function query($data)
    {

        $i=new Idioma();
        $i->setId($data["idioma_id"]);
        $i->setNombre($data["idioma_name"]);
        $i->setShort($data["idioma_short"]);
        $i->setPredeterminado($data["idioma_predeterminado"]);

        array_push($this->idiomas, $i);

    }



    public function selectIdiomaById($id)
    {
        $this->idiomas=array();
        $sql = "SELECT * FROM {$this->tableName}  WHERE idioma_id=:idioma_id";
        $this->idiomas=array();
        $this->dataSource->runQuery($sql,array(
            ":idioma_id"=>$id
        ),function($data){


            $this->query($data);

        });

        return $this->idiomas;
    }

    public function selectIdiomaByName($name)
    {
        $this->idiomas=array();
        $sql = "SELECT * FROM {$this->tableName}  WHERE idioma_name=:idioma_name";
        $this->idiomas=array();
        $this->dataSource->runQuery($sql,array(
            ":idioma_name"=>$name
        ),function($data){


            $this->query($data);

        });

        return $this->idiomas;
    }


    public function selectIdiomaByShort($short)
    {
        $this->idiomas=array();
        $sql = "SELECT * FROM {$this->tableName}  WHERE idioma_short=:idioma_short";
        $this->idiomas=array();
        $this->dataSource->runQuery($sql,array(
            ":idioma_short"=>$short
        ),function($data){


            $this->query($data);

        });

        return $this->idiomas;
    }


    public function selectIdiomaPredeterminado()
    {
        $this->idiomas=array();
        $sql = "SELECT * FROM {$this->tableName}  WHERE idioma_predeterminado=1";
        $this->idiomas=array();
        $this->dataSource->runQuery($sql,function($data){


            $this->query($data);

        });

        return $this->idiomas;
    }



    public function updateIdioma(Idioma $i)
    {
        // TODO: Implement updateIdioma() method.
    }

    public function deleteIdiomaById($id)
    {
        // TODO: Implement deleteIdiomaById() method.
    }

    public function validate(Idioma $s)
    {
        // TODO: Implement validate() method.
    }


}