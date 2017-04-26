<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 28/03/2017
 * Time: 2:58
 */

require_once ("Repositorio.php");
require_once ("IRepositorio.php");

class RepositorioDAO implements IRepositorio
{
    protected $dataSource;
    protected $tableName;
    protected  $repositorios=array();


    private $insertSql;
    private $updateSql;
    /**
     * RepositorioDAO constructor.
     * @param $dataSource
     * @param $tableName
     */
    public function __construct(DataSource $dataSource, $tableName="repositorios")
    {


        $this->dataSource = $dataSource;
        $this->tableName = $tableName;
        $this->insertSql="INSERT INTO  {$this->tableName} 
 (repositorio_id,repositorio_name,repositorio_path,repositorio_host,repositorio_user,repositorio_pass,repositorio_port,repositorio_creation,repositorio_modification,repositorio_url,repositorio_versiones)
 VALUES (:repositorio_id,:repositorio_name,:repositorio_path,:repositorio_host,:repositorio_user,:repositorio_pass,:repositorio_port,:repositorio_creation,:repositorio_modification,:repositorio_url,:repositorio_versiones)";

        $this->updateSql="UPDATE {$this->tableName}  SET repositorio_id=:repositorio_id,repositorio_name=:repositorio_name,
repositorio_path=:repositorio_path,repositorio_host=:repositorio_host,
repositorio_user=:repositorio_user,repositorio_pass=:repositorio_pass,
repositorio_port=:repositorio_port,repositorio_creation=:repositorio_creation,
repositorio_modification=:repositorio_modification,repositorio_url=:repositorio_url,repositorio_versiones=:repositorio_versiones WHERE  repositorio_id=:repositorio_id";

    }




    public function insertRepositorio(Repositorio $r)
    {

        $this->validate($r);
        
        $sql = $this->insertSql;
        if(!$r->getCreation())
        {
            $r->setCreation(time());
        }
        if(!$r->getModification())
        {
            $r->setModification(time());
        }

        $res= $this->dataSource->runUpdate($sql,
          $this->getParamsArray($r)
        );
        return $res;
    }

    protected function getParamsArray(Repositorio $r)
    {
        return   array(
            ":repositorio_id"=>$r->getId(),
            ":repositorio_name"=>$r->getName(),
            ":repositorio_path"=>$r->getPath(),
            ":repositorio_host"=>$r->getHost(),
            ":repositorio_user"=>$r->getUser(),
            ":repositorio_pass"=>$r->getPass(),
            ":repositorio_port"=>$r->getPort(),
            ":repositorio_creation"=>$r->getCreation(),
            ":repositorio_modification"=>$r->getModification(),
            ":repositorio_url"=>$r->getUrl(),
            ":repositorio_versiones"=>json_encode($r->getVersiones())
        );
    }

    /**
     * @param $data Datos del repositorio
     * @param string $assoc Le indico si debe introducir el objeto en el array con su id como clave
     *
     */
    private function query($data,$assoc=false)
    {

        $r =new Repositorio($data["repositorio_host"],$data["repositorio_user"],
        $data["repositorio_pass"],$data["repositorio_name"], $data["repositorio_path"],
        $data["repositorio_port"],$data["repositorio_creation"],
        $data["repositorio_modification"],$data["repositorio_id"]);

        $r->setUrl($data["repositorio_url"]);
        $r->setVersiones(json_decode($data["repositorio_versiones"],true));
        if(!$assoc)
        {
            array_push($this->repositorios, $r);
        }
        else
        {
            $this->repositorios[$r->getId()]=$r;
        }



    }

    private function processArchivos()
    {
        $in = "";
        foreach ($this->repositorios as $r)
        {
            $in.="{$r->getId()},";
        }
        $in =rtrim($in,",");

        $archivos= $GLOBALS["archivoDAO"]->selectArchivoByRepositorioId($in,false);
        $archivosRepositorio=array();
        foreach ($archivos as $archivo )
        {


            if($archivo->getVersion()==0)
            {
                $idOriginal=$archivo->getId();
            }
            else
            {
                $idOriginal=$archivo->getVersion();
            }

          
            $archivosRepositorio [$archivo->getType()][$archivo->getGaleria()][$idOriginal][$archivo->getVersionName()] = $archivo;


            $this->repositorios[$archivo->getRepositorio(true)]->setFiles($archivosRepositorio);

        }
    }

    public function selectGalerias()
    {
      $sql="SELECT archivo_galeria FROM archivos GROUP BY archivo_galeria";
        $galerias=array();
        $this->dataSource->runQuery($sql,array(),function($data){

            $galerias[]=$data["archivo_galeria"];

        });

        return $galerias;
    }

    public function selectTipos()
    {
        $sql="SELECT archivo_tipo FROM archivos GROUP BY archivo_tipo";
        $tipos=array();
        $this->dataSource->runQuery($sql,array(),function($data){

            $tipos[]=$data["archivo_tipo"];

        });

        return $tipos;
    }


    public function selectRepositorios($withFiles=true)
    {

        $this->repositorios=array();
        $sql = "SELECT * FROM {$this->tableName} ";


      $this->dataSource->runQuery($sql,array(),function($data){
          
            $this->query($data,true);

        });

        if($withFiles)
        {
         
            $this->processArchivos();
        }






    return $this->repositorios;
    }

    public function selectRepositorioById($id,$withFiles=true)
    {


        $this->repositorios = array();
        $sql = "SELECT * FROM {$this->tableName} WHERE repositorio_id=:repositorio_id";


        $this->dataSource->runQuery($sql, array(
            ":repositorio_id" => $id
        ), function ($data) {

            $this->query($data, true);

        });
       
        if($withFiles)
        {
            $this->processArchivos();
       }

       return $this->repositorios;
    }

    public function updateRepositorio(Repositorio $r)
    {
        $this->validate($r);

        $sql=$this->updateSql;

        $r->setModification(time());

        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($r));
        return $res;

    }

    public function deleteRepositorioById($id)
    {



        $archivos=  $GLOBALS["archivoDAO"]->selectArchivoOriginalByRepositorioId($id);

var_dump($archivos);

        foreach ($archivos as $archivo)
        {

           $GLOBALS["archivoDAO"]->deleteArchivoById($archivo->getId());
        }


        $sql = "DELETE FROM {$this->tableName} WHERE repositorio_id= :repositorio_id";

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":repositorio_id"=>$id
            ));
        return $res;


        }

    public function validate(Repositorio $r)
    {
        // TODO: Implement validate() method.
    }


}
