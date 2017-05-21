<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 23:15
 */

require_once ("ISeccion.php");
require_once ("Seccion.php");


class SeccionDAO implements ISeccion
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

    public function selectSeccionesByTipo($tipo)
    {



        $sql = "SELECT * FROM {$this->tableName} WHERE seccion_tipo={$tipo}";
        $this->secciones=array();
        $this->dataSource->runQuery($sql,array(),function($data){




            $this->query($data);

        });

        return $this->secciones;
    }

    private function arrangeSeccionesTree($s,&$array)
    {
        $tipo=$s->getTipo();
        $id=$s->getId();


            if($tipo==0)
            {
                $array[$id]=$s;


            }
            else
            {

                if($array[$tipo])
                {
                    $secciones = $array[$tipo]->getSecciones();

                    $secciones[$id]=$s;
                    $array[$tipo]->setSecciones($secciones);

                }
                else
                {
                    foreach ($array as $seccion)
                    {
                        if(count($seccion->getSecciones())>0)
                        {
                            $this->arrangeSeccionesTree($s,$seccion->getSecciones());
                        }

                    }

                }


            }




    }

    public function selectSeccionesSubsecciones($cantPosts=false)
    {
        $this->secciones=array();


        if(!$cantPosts)
        {
            if(is_numeric($tipo))
            {
                $sql = "SELECT * FROM {$this->tableName} WHERE seccion_tipo={$tipo} OR seccion_id={$tipo}";
            }
            else
            {
                $sql = "SELECT * FROM {$this->tableName}";
            }


        }
        else
        {
                $sql = "SELECT s . * , COUNT( p.post_seccion ) AS posts
FROM secciones s
LEFT JOIN posts p ON p.post_seccion = s.seccion_id
GROUP BY s.seccion_id";


        }




        $this->dataSource->runQuery($sql,array(),function($data){

            $s=new Seccion();
            $s->setId($data["seccion_id"]);
            $s->setNombre($data["seccion_nombre"]);
            $s->setTipo($data["seccion_tipo"]);
            if($data["posts"])
            {
                $s->setCantPosts($data["posts"]);
            }



            $this->arrangeSeccionesTree($s,$this->secciones);



        });


        return $this->secciones;
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

        array_push($this->secciones, $s);

    }

 

    public function selectSecciones()
    {        $this->secciones=array();
        $sql = "SELECT * FROM {$this->tableName}";
        $this->secciones=array();
        $this->dataSource->runQuery($sql,array(),function($data){



            $this->query($data);

        });

        return $this->secciones;
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

        $sql = "DELETE FROM {$this->tableName} WHERE seccion_id= :seccion_id ";
        
        //TODO: implementar eliminacion recursiva 

        
        
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