<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 23/03/2017
 * Time: 01:13 PM
 */


require_once ("IArchivo.php");
require_once ("Archivo.php");


class ArchivoDAO extends Paginable implements IArchivo
{

    private $updateSql;
    private $insertSql;
    private $deleteSql;
    protected $dataSource;
    protected $tableName;
    protected $files=array();

    public function __construct(DataSource $dataSource, $tableName="archivos")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;

        $this->updateSql="UPDATE {$this->tableName} SET
archivo_id=:archivo_id, archivo_size=:archivo_size,archivo_mime=:archivo_mime, archivo_name=:archivo_name, 
 archivo_extension=:archivo_extension, archivo_creation=:archivo_creation, 
 archivo_modification=:archivo_modification,archivo_repositorio=:archivo_repositorio,archivo_path=:archivo_path
 ,archivo_version=:archivo_version,archivo_real_name=:archivo_real_name,archivo_version_name=:archivo_version_name,archivo_galeria=:archivo_galeria,
 ,archivo_alto=:archivo_alto,archivo_ancho=:archivo_ancho,archivo_type=:archivo_type,archivo_path_name=:archivo_path_name
   WHERE archivo_id=:archivo_id OR archivo_version=:archivo_id ";

        $this->insertSql="INSERT INTO  {$this->tableName} 
 (archivo_id, archivo_size, archivo_mime,archivo_name, archivo_extension,
   archivo_creation, archivo_modification,archivo_repositorio,archivo_path,archivo_version,
   archivo_real_name,archivo_version_name,archivo_alto,archivo_ancho,archivo_type,archivo_galeria,archivo_path_name)
 VALUES (:archivo_id, :archivo_size,:archivo_mime, :archivo_name, 
 :archivo_extension, :archivo_creation, 
 :archivo_modification,:archivo_repositorio,:archivo_path,:archivo_version,:archivo_real_name,:archivo_version_name,:archivo_ancho,:archivo_alto,:archivo_type,:archivo_galeria,:archivo_path_name)";

        $this->deleteSql="DELETE FROM {$this->tableName} WHERE archivo_id= :archivo_id OR archivo_version= :archivo_id";

    }




    private function processArchivos()
    {

        $archivos = array();
        foreach ($this->files as $archivo )
        {

            if($archivo->getVersion()==0)
            {
                $idOriginal=$archivo->getId();
            }
            else
            {
                $idOriginal=$archivo->getVersion();
            }


            $archivos [$archivo->getType()][$archivo->getGaleria()][$idOriginal][$archivo->getVersionName()] = $archivo;


        }
        $this->files=$archivos;
    }

    public function insertArchivo(IArchivo $a,$versionName="original",$versionId=0)
    {
        $this->validate($a);

        $r =$a->getRepositorio();

        $ftp  =$r->getFtp();

        $mainPath = time().".{$a->getExtension()}"; //Nombre de la carpeta contenedora de todas las versiones

        $mainPath=$r->getDatePath()."{$mainPath}"; //Directorio donde estan todas las versiones
        
        $fileNameVersion = time()."_{$versionName}.{$a->getExtension()}";//Nombre del archivo con su version

        $mainFolder= $r->getPath().$mainPath; //La ruta de la carpeta,excluyendo el archivo
        
        $a->setPathName($mainPath);

        $mainPath="{$mainPath}/{$fileNameVersion}";

        $fullDir = $r->getPath().$mainPath; //Directorio completo, nombre del archivo incluido

        if(!$ftp->isDir($mainFolder))//Chequeo si no existe el directorio, en tal caso lo creo
        {
            $ftp->mkdir($mainFolder,true);
        }


     //   echo json_encode(array("fullDir"=>$fullDir,"tmpDir"=>$a->getTmpPath()));

      //  echo json_encode( $r->getName());

       // echo json_encode($ftp->put("/httpdocs/data/2017/04/12/1492008967.jpg/1492008967_original.jpg","C:/xampp5/htdocs/adhoc-framework/tmp/files/606453_7up.jpg",FTP_BINARY));
    //    exit();

  /*      echo $fullDir." ".$a->getTmpPath();

        exit();
*/
        $ftp->pasv(true);
        if(!$ftp->put($fullDir,$a->getTmpPath(),FTP_BINARY))
        {
            throw new Exception("ArchivoDAO:0");
        }

            $a->setVersion($versionId);


        $a->setRealName($r->getUrl().$mainPath); //Url + Ruta completa
        $a->setVersionName($versionName);


        $sql = $this->insertSql;

        if(!$a->getCreation())
        {
            $a->setCreation(time());
        }
        if(!$a->getModification())
        {
            $a->setModification(time());
        }

        $a->setPath($mainPath);

        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($a));
        return $res;
    }

    public function selectArchivos($process=true)
    {
        $this->files=array();

        $sql = "SELECT * FROM {$this->tableName} LEFT JOIN
 repositorios ON repositorio_id=archivo_repositorio";

        if($this->getLimit())
        {
            $sql.="  LIMIT {$this->getLimit()} OFFSET {$this->getOffset()}";
        }



        $this->dataSource->runQuery($sql,array(),function($data){


            $r =new Repositorio($data["repositorio_host"],$data["repositorio_user"],
                $data["repositorio_pass"],$data["repositorio_name"], $data["repositorio_path"],
                $data["repositorio_port"],$data["repositorio_creation"],
                $data["repositorio_modification"],$data["repositorio_id"]);


            $a = new Archivo($data["archivo_size"],$data["archivo_name"],$data["archivo_mime"],
                $data["archivo_version"],$data["archivo_real_name"],null,$r,
                $data["archivo_path"],$data["archivo_creation"],
                $data["archivo_modification"],$data["archivo_id"],$data["archivo_version_name"],$data["archivo_type"]);
            array_push($this->files, $a);

            $a->setPathName($data["archivo_path_name"]);

        });
        if($process)
        {

            $this->processArchivos();
        }

        return $this->files;


    }
    public function setResults($sql)
    {

        parent::setResults(count($this->dataSource->runQuery($sql)));
    }

    /**
     * @param $in Especifico los ids de los repositorios de los archivos que quiero traer
     * @param bool $process Si me procesa la salida en un array ordenado en $array[tipo][galeria/grupo][id_del_original][version]
     * @param bool $version Version/es  de los archivos que quiero traer
     * @return array
     * @throws Exception
     */
    public function selectArchivoByRepositorioId($in,$process=true,$version=false)
    {
        $this->files=array();

        $sql = "SELECT * FROM {$this->tableName} WHERE archivo_repositorio IN ({$in})";


        if(is_array($version)){

            $v ="";

            foreach ($version as $version)
            {
                $v.="'{$version}',";
            }

            $v =rtrim($v,",");

            $sql.=" AND archivo_version_name IN ({$v})";
        }

        $sql.=" ORDER BY archivo_creation DESC";

        $this->setResults($sql);

        if($this->getLimit())
        {
            $sql.="  LIMIT {$this->getLimit()} OFFSET {$this->getOffset()}";
        }

        $this->dataSource->runQuery($sql,array(),
            function($data){


                $this->query($data);
            });


        if($process)
        {

            $this->processArchivos();

        }


        return $this->files;

    }
    public function selectArchivoOriginalByRepositorioId($in,$process=true)
    {
        $this->files=array();

        $sql = "SELECT * FROM {$this->tableName} WHERE archivo_repositorio IN ({$in}) AND archivo_version_name='original'";

        $this->setResults($sql);

        if($this->getLimit())
        {
            $sql.="  LIMIT {$this->getLimit()} OFFSET {$this->getOffset()}";
        }


        $this->dataSource->runQuery($sql,array(),
            function($data){


                $this->query($data);
            });

        if($process)
        {

            $this->processArchivos();
        }


        return $this->files;
    }
    public function selectArchivoByVersions($id,$process=true)
    {
        $this->files=array();

        $sql = "SELECT * FROM {$this->tableName} WHERE archivo_id=:archivo_id OR archivo_version=:archivo_id";
        $this->setResults($sql);

        if($this->getLimit())
        {
            $sql.="  LIMIT {$this->getLimit()} OFFSET {$this->getOffset()}";
        }


        $this->dataSource->runQuery($sql,array(":archivo_id"=>$id),
            function($data){
            $this->query($data);
            });
        if($process)
        {

            $this->processArchivos();
        }
        return $this->files;

    }


    private function query($data){


        $repositorioDAO = new RepositorioDAO($this->dataSource);

    
        $repositorio=$data["archivo_repositorio"];

        switch ($data["archivo_type"])
        {
            case 0:
                $a = new Archivo($data["archivo_size"],$data["archivo_name"],$data["archivo_mime"],
                    $data["archivo_version"],$data["archivo_real_name"],null,$repositorio,
                    $data["archivo_path"],$data["archivo_creation"],
                    $data["archivo_modification"],$data["archivo_id"],$data["archivo_version_name"],$data["archivo_type"]);
                $a->setPathName($data["archivo_path_name"]);
                break;
            
            case 1:
                $a = new Imagen($data["archivo_size"],$data["archivo_name"],$data["archivo_mime"],
                    $data["archivo_version"],$data["archivo_real_name"],null,$repositorio,
                    $data["archivo_path"],$data["archivo_creation"],
                    $data["archivo_modification"],$data["archivo_id"],$data["archivo_version_name"],$data["archivo_ancho"],$data["archivo_alto"]);
                $a->setPathName($data["archivo_path_name"]);
                break;

            case 4:
             $a = new Documento($data["archivo_size"],$data["archivo_name"],$data["archivo_mime"],
                    $data["archivo_version"],$data["archivo_real_name"],null,$repositorio,
                    $data["archivo_path"],$data["archivo_creation"],
                    $data["archivo_modification"],$data["archivo_id"],$data["archivo_version_name"],$data["archivo_type"]);
                $a->setPathName($data["archivo_path_name"]);

                break;
        }
        
   
        array_push($this->files, $a);

    }


    protected function getParamsArray(Archivo $a)
    {

        $ancho =null;
        $alto=null;

        if(method_exists($a,"getAncho"))//si el objeto Archivo es una Imagen
        {
            $ancho = $a->getAncho();
            $alto =$a->getAlto();
        }
        return array(
            ":archivo_id"=>$a->getId(),
            ":archivo_size"=>$a->getSize(),
            ":archivo_name"=>$a->getName(),
            ":archivo_extension"=>$a->getExtension(),
            ":archivo_mime"=>$a->getMime(),
            ":archivo_creation"=>$a->getCreation(),
            ":archivo_modification"=>$a->getModification(),
            ":archivo_repositorio"=>$a->getRepositorio()->getId(),
            ":archivo_path"=>$a->getPath(),
            ":archivo_version"=>$a->getVersion(),
            ":archivo_real_name"=>$a->getRealName(),
            ":archivo_version_name"=>$a->getVersionName(),
            ":archivo_ancho"=>$ancho,
            ":archivo_alto"=>$alto,
            ":archivo_type"=>$a->getType(),
            ":archivo_galeria"=>$a->getGaleria(),
            ":archivo_path_name"=>$a->getPathName()
        );
    }



    public function selectArchivoById($id,$process=true)
    {


        $sql = "SELECT * FROM {$this->tableName} WHERE archivo_id=:archivo_id";

        $this->dataSource->runQuery($sql,array(":archivo_id"=>$id),function($data){

            $this->query($data);
        });
        if($process)
        {

            $this->processArchivos();
        }
        return $this->files;


    }

    public function updateArchivo(IArchivo $a)
    {

        $this->validate($a);

        $sql=$this->updateSql;

        $a->setModification(time());

        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($a));
        return $res;

    }


    /**
     * @param $in |Id del archivo, o array de archivos
     * @return string
     * @throws Exception
     */
    public function deleteArchivoById($in)
    {

        $archivos=array();
        if (is_array($in))
        {
            foreach ($in as $file)
            {

                /** Chequeo si los archivos tienen objetos asociados**/

                $sqlArchivosObjetos="SELECT * FROM archivos_objetos WHERE archivo_id=:archivo_id";

                $objetosAsociados=count($this->dataSource->runQuery($sqlArchivosObjetos,array(":archivo_id"=>$file["archivo_id"])));

                if($objetosAsociados>0)
                {
                    throw new Exception("ArchivoDAO:3");//Codigo de error al intentar eliminar un archivo con objetos asociados

                }

                /** **/


                $archivos=array_merge($archivos,$this->selectArchivoByVersions($file["archivo_id"],false));
            }


        }
        else
        {
            $archivos=$this->selectArchivoByVersions($in,false);
        }



       $repositorio= $archivos[0]->getRepositorio();
       $ftp=$repositorio->getFtp();




        $deletePath=$repositorio->getPath().$archivos[0]->getPathName();

        foreach ($archivos as $archivo)
        {
            $deleteFile= $repositorio->getPath().$archivo->getPath();

            var_dump($deleteFile);

            /*if(!$ftp->delete($deleteFile))//Elimino cada archivo
            {
                throw new Exception("ArchivoDAO:1");//Codigo de error al eliminar un archivo
            }*/
        }

        exit();

        $deletePath=$repositorio->getPath().$archivos[0]->getPathName();

        if(!$ftp->remove($deletePath))//Elimino la carpeta
        {
            throw new Exception("ArchivoDAO:2");//Codigo de error al eliminar una carpeta
        }

        $ftp->close();

        $sql = $this->deleteSql;

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":archivo_id"=>$id
            ));
        return $res;
    }

    public function validate(IArchivo $a)
    {
        // TODO: Implement validate() method.
    }


}