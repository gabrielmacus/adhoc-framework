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

    protected $updateSql;
    protected $insertSql;
    protected $deleteSql;
    protected $dataSource;
    protected $tableName;
    protected $files=array();
    protected $filters=array();

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

    protected function processArchivos()
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

    /**
     * @return string
     */
    public function getUpdateSql()
    {
        return $this->updateSql;
    }

    /**
     * @param string $updateSql
     */
    public function setUpdateSql($updateSql)
    {
        $this->updateSql = $updateSql;
    }

    /**
     * @return string
     */
    public function getInsertSql()
    {
        return $this->insertSql;
    }

    /**
     * @param string $insertSql
     */
    public function setInsertSql($insertSql)
    {
        $this->insertSql = $insertSql;
    }

    /**
     * @return string
     */
    public function getDeleteSql()
    {
        return $this->deleteSql;
    }

    /**
     * @param string $deleteSql
     */
    public function setDeleteSql($deleteSql)
    {
        $this->deleteSql = $deleteSql;
    }

    /**
     * @return DataSource
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @param DataSource $dataSource
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    

    public function insertArchivo(Archivo $a,$versionName="original",$versionId=0,$mainPath=false)
    {
        $this->validate($a);

     
            $r =$a->getRepositorio();

            $ftp  =$r->getFtp();

            $randName=substr($a->getName(),0,6).rand(0,9999);

            if(!$mainPath)
            {
                $mainPath = time()."{$randName}.{$a->getExtension()}"; //Nombre de la carpeta contenedora de todas las versiones

            }

            $mainPath=$r->getDatePath()."{$mainPath}"; //Directorio donde estan todas las versiones

            $fileNameVersion = time()."_{$randName}_{$versionName}.{$a->getExtension()}";//Nombre del archivo con su version

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

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }


    public function setResults($sql)
    {

        $sql="SELECT count(*) as 'total' FROM ({$sql}) as tabla";

        $r=$this->dataSource->runQuery($sql)[0]['total'];


        parent::setResults($r);
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
        $this->files = array();

        $where="archivo_repositorio IN ({$in})";

        $orderBy=  "archivo_creation DESC";

        /***
         * Traigo los originales para paginarlos
         */

        $sql = "SELECT * FROM {$this->tableName} WHERE archivo_version=0 AND {$where}";

        $sql.=" ORDER BY {$orderBy}";

        $offset = $this->getOffset();


        if ($this->getLimit()) {
            $sql .= "  LIMIT {$this->getLimit()} OFFSET {$offset}";
        }



        $originales = $this->dataSource->runQuery($sql);


        //Lista de los ids que traje
        $ids=[];
        foreach ($originales as $o)
        {
            $ids[]=$o["archivo_id"];
        }


        //Calculo la cant de resultados
        $this->setResults($where);

        /**
         *
         */

        /**
         * Traigo las versiones requeridas
         */



        if(is_array($version))
        {

            $v ="";

            foreach ($version as $version)
            {
                $v.="'{$version}',";
            }

            $v =rtrim($v,",");

            $where.=" AND archivo_version_name IN ({$v})";

            //Agrego los ids de los originales a la consulta para traer sus respectivas versiones
          $ids = implode("," ,$ids);
           $where.=" AND  archivo_id IN ({$ids})";


            $sql = "SELECT * FROM {$this->tableName} WHERE {$where}";

            $sql.=" ORDER BY {$orderBy}";

            $offset=$this->getOffset();

            if($this->getLimit())
            {
                $sql.="  LIMIT {$this->getLimit()} OFFSET {$offset}";
            }



          $versiones=  $this->dataSource->runQuery($sql);



        }


        /**
         *
         *
         */


        /**
         * Uno originales + versiones, y los paso a objetos
         */



        if($versiones)
        {

            $archivos = array_merge($originales,$versiones);
        }
        else
        {
            $archivos = $originales;
        }

        foreach ($archivos as $archivo)
        {
          $this->query($archivo);
        }



        /**
         */


        if($process)
        {

            $this->processArchivos();

        }


        return $this->files;

    }
    /**
     * @param bool $process Si me procesa la salida en un array ordenado en $array[tipo][galeria/grupo][id_del_original][version]
     *
     * Traigo todos los archivos existentes
     */
    public function selectArchivos($process=true)
    {

        $this->files=array();

        $sql="SELECT * FROM archivos ";

        /** 21.06.2017: Filtros **/

        $orderBy=" ORDER BY `archivo_creation` DESC ";

        $where="";

        if(!empty($this->filters))
        {

            if(is_array($this->filters["repositorios"]) && !empty($this->filters["repositorios"]))
            {

                $r = implode(",",$this->filters["repositorios"]);
                $where.= (empty($where))?" WHERE archivo_repositorio IN ({$r}) ":" AND  archivo_repositorio IN ({$r}) ";
            }

            if(!empty($this->filters["size"]) )
            {
                $size=$this->filters["size"];
                $where.= (empty($where))?" WHERE archivo_size {$size} ":" AND  archivo_size {$size} ";

            }

            if(is_array($this->filters["formats"]) && !empty($this->filters["formats"]))
            {

                $formats = array_map(function($f){

                    return "'{$f}'";

                },$this->filters["formats"]);

                $formats=implode(",",$formats);

                $where.= (empty($where))?" WHERE archivo_extension IN ({$formats}) ":" AND  archivo_extension IN ({$formats}) ";

            }

            if(is_array($this->filters["exclude"]) && !empty($this->filters["exclude"]))
            {
                $exclude=implode(",",$this->filters["exclude"]);

                $where.= (empty($where))?" WHERE archivo_id NOT IN ({$exclude}) ":" AND archivo_id NOT IN ({$exclude}) ";

            }


            if($name=$this->filters["exclude"])
            {


                $formats = array_map(function($f){

                    return "'{$f}'";

                },$this->filters["formats"]);

                $formats=implode(",",$formats);
                $where.= (empty($where))?" WHERE archivo_id IN  '%{$size}%' ":" AND   archivo_name LIKE  '%{$size}%' ";

            }


        }


        $where.= (empty($where))?" WHERE  archivo_version = 0  ":" AND  archivo_version = 0 ";

        $sql.=" {$where} {$orderBy}";

        /** Paginacion */
        $this->setResults($sql);

        $offset = $this->getOffset();

        if ($this->getLimit()) {
            $sql .= "  LIMIT {$this->getLimit()} OFFSET {$offset}";
        }


        /** ** */




        $res = $this->dataSource->runQuery($sql);

        $in="";

        foreach ($res as $r)
        {
           $in.="{$r["archivo_id"]},";
        }

        $in =rtrim($in,",");

        $sql ="SELECT * FROM archivos WHERE archivo_id IN ({$in}) OR archivo_version IN ({$in}) {$orderBy}";

        $res = $this->dataSource->runQuery($sql);

        foreach ($res as $archivo)
        {
            $this->query($archivo);
        }


        if($process)
        {
            $this->processArchivos();
        }

        return $this->files;


        /** ** */

    }

    /**
     * @param $id Id del archivo
     * @param bool $process Si me procesa la salida en un array ordenado en $array[tipo][galeria/grupo][id_del_original][version]
     * @param $versions Indica si traigo el archivo y sus versiones
     * @return array
     * @throws Exception
     *
     * Traigo un archivo especifico por id
     */
    public function selectArchivoById($id,$process=true,$versions=true)
    {

        $this->files=array();

        $sql = "SELECT * FROM {$this->tableName} WHERE archivo_id=:archivo_id";
        if($versions)
        {
            $sql.=" OR archivo_version=:archivo_id";
        }

        $this->dataSource->runQuery($sql,array(":archivo_id"=>$id),function($data){

            $this->query($data);
        });
        if($process)
        {

            $this->processArchivos();
        }
        return $this->files;


    }

    protected function query($data){


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
            case 3:

                $a = new Audio($data["archivo_size"],$data["archivo_name"],$data["archivo_mime"],
                    $data["archivo_version"],$data["archivo_real_name"],null,$repositorio,
                    $data["archivo_path"],$data["archivo_creation"],
                    $data["archivo_modification"],$data["archivo_id"],$data["archivo_version_name"],$data["archivo_type"]);
                $a->setPathName($data["archivo_path_name"]);

                break;

            case 4:
             $a = new Documento($data["archivo_size"],$data["archivo_name"],$data["archivo_mime"],
                    $data["archivo_version"],$data["archivo_real_name"],null,$repositorio,
                    $data["archivo_path"],$data["archivo_creation"],
                    $data["archivo_modification"],$data["archivo_id"],$data["archivo_version_name"],$data["archivo_type"]);
                $a->setPathName($data["archivo_path_name"]);

                break;
            case 5:
                $a = new VideoYT($data["archivo_size"],$data["archivo_name"],$data["archivo_mime"],
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
     * @param $ids |Id del archivo, o array de archivos
     * @return string
     * @throws Exception
     */

    public function deleteArchivoById($ids)
    {


        $archivos=array();
        if (is_array($ids))
        {
            foreach ($ids as $file)
            {

                /** Chequeo si los archivos tienen objetos asociados**/

                $sqlArchivosObjetos="SELECT * FROM archivos_objetos WHERE archivo_id=:archivo_id";

                $objetosAsociados=count($this->dataSource->runQuery($sqlArchivosObjetos,array(":archivo_id"=>$file["archivo_id"])));


                if($objetosAsociados>0)
                {
                    throw new Exception("ArchivoDAO:3");//Codigo de error al intentar eliminar un archivo con objetos asociados

                }

                /** **/




              $archivos[]=$this->selectArchivoById($file["archivo_id"],false);
            }


        }
        else
        {
            $archivos=$this->selectArchivoById($ids,false);
        }

        foreach ($archivos as $archivo)
        {

            $repositorio= reset($archivo)->getRepositorio();
            $ftp=$repositorio->getFtp();

            foreach ($archivo as $version)
            {

                $type= $version->getType();

                switch ($type)
                {
                    default:
                        $dontDeleteFolder=false;
                        $deleteFile=$repositorio->getPath().$version->getPath();


                        if(!$ftp->delete($deleteFile))
                        {
                            throw new Exception("ArchivoDAO:1:".$deleteFile);//Codigo de error al eliminar un archivo
                        }


                        $sql ="DELETE FROM {$this->tableName} WHERE archivo_id = :archivo_id";

                        $res= $this->dataSource->runUpdate($sql,array(
                            ":archivo_id"=>$version->getId()
                        ));
                        break;

                    case "6":
                    case "5":


                        $sql ="DELETE FROM {$this->tableName} WHERE archivo_id = :archivo_id";

                        $dontDeleteFolder=true;


                        $res= $this->dataSource->runUpdate($sql,array(
                            ":archivo_id"=>$version->getId()
                        ));

                        break;
                }




            }

            if(!$dontDeleteFolder)
            {
                $deletePath=$repositorio->getPath().reset($archivo)->getPathName();

                if(!$ftp->remove($deletePath))//Elimino la carpeta
                {
                    throw new Exception("ArchivoDAO:2:{$deletePath}");//Codigo de error al eliminar una carpeta
                }

            }

        }


     return true;

    }

    public function validate(IArchivo $a)
    {
        // TODO: Implement validate() method.
    }


}