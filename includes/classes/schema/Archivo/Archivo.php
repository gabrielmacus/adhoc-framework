<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 23/03/2017
 * Time: 06:01 PM
 */
class Archivo implements JsonSerializable
{

    protected $size;
    protected $name;
    protected $extension;
    protected $mime;
    protected $creation;
    protected $tmpPath;
    protected $modification;
    protected $id;
    protected $config;
    protected $repositorio;
    protected  $path;
    protected $realName;
    protected $version;
    protected $versionName;
    protected $type;
    protected $nexoId;
    /**
     * @var int
     * @deprecated
     */
    protected $galeria=0;
    protected $pathName;
    protected $grupo;
    protected $nexo;
    protected $orden;

    /**
     * Archivo constructor.
     * @param $size
     * @param $name
     * @param $mime
     * @param $tmpPath
     * @param $creation
     * @param $modification
     * @param $repositorio
     * @param $id
     */
    
    public function __construct($size, $name, $mime,$version=null,$realName=null, $tmpPath=null,$repositorio,$path=null,$creation=null, $modification=null,$id=null,$versionName=null,$type=0)
    {

        $this->size = $size;
        $this->name = $name;

        $this->mime = $mime;
        $this->tmpPath=$tmpPath;
        $this->creation = $creation;
        $this->modification = $modification;
        $this->id = $id;
        $this->repositorio=$repositorio;
        $this->path=$path;
        $ext = explode(".",$path);
        $this->extension  = $ext[count($ext)-1];
        $this->version=$version;
        $this->realName=$realName;
        $this->versionName=$versionName;
        $this->type=$type;
    }

    /**
     * @return mixed
     */
    public function getNexoId()
    {
        return $this->nexoId;
    }

    /**
     * @param mixed $nexoId
     */
    public function setNexoId($nexoId)
    {
        $this->nexoId = $nexoId;
    }

    /**
     * @return mixed
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * @param mixed $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    }

    


    function jsonSerialize()
    {
       return array(
           "size"=>$this->getSize(),
           "name"=>$this->getName(),
           "extension"=>$this->getExtension(),
           "mime"=>$this->getMime(),
           "creation"=>$this->getCreation(),
           "modification"=>$this->getModification(),
           "id"=>$this->getId(),
           "config"=>$this->getConfig(),
           "repositorio"=>$this->getRepositorio(),
           "path"=>$this->getPath(),
           "realName"=>$this->getRealName(),
           "version"=>$this->getVersion(),
           "type"=>$this->getType(),
           "pathName"=>$this->getPathName(),
           "nexo"=>$this->getNexo(),
           "grupo"=>$this->getGrupo(),
           "nexoId"=>$this->getNexoId(),
           "orden"=>$this->getOrden()
           
           
       );
    }

    /**
     * @return mixed
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * @param mixed $grupo
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;
    }

    

    /**
     * @return mixed
     */
    public function getNexo()
    {
        return $this->nexo;
    }

    /**
     * @param mixed $nexo
     */
    public function setNexo($nexo)
    {
        $this->nexo = $nexo;
    }


    /**
     * @return mixed
     */
    public function getPathName()
    {
        return $this->pathName;
    }

    /**
     * @param mixed $pathName
     */
    public function setPathName($pathName)
    {
        $this->pathName = $pathName;
    }



   
    /**
     * @return mixed
     */
    public function getGaleria()
    {
        return $this->galeria;
    }

    /**
     * @param mixed $galeria
     */
    public function setGaleria($galeria)
    {
        $this->galeria = $galeria;
    }

    

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    
    /**
     * @return null
     */
    public function getVersionName()
    {
        return $this->versionName;
    }

    /**
     * @param null $versionName
     */
    public function setVersionName($versionName)
    {
        $this->versionName = $versionName;
    }




    /**
     * @return bool
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * @param bool $realName
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }


    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }


    /**
     * @param bool $getIdOnly  Si es true, me devuelve la id del repositorio,no el objeto
     * @return Repositorio|int
     */
    public function getRepositorio($getIdOnly=false)
    {

        if(is_numeric($this->repositorio) && !$getIdOnly) //Si es un numero, el repositorio debe ser cargado con una consulta
        {


            $this->repositorio =reset( $GLOBALS["repositorioDAO"]->selectRepositorioById($this->repositorio));

      
        }
        elseif($getIdOnly)
        {
            if(is_object($this->repositorio))
            {
               return $this->repositorio->getId();
            }
        }
        return $this->repositorio;
    }

    /**
     * @param Repositorio $repositorio
     */
    public function setRepositorio($repositorio)
    {
        $this->repositorio = $repositorio;
    }


    
    /**
     * @return mixed
     */
    public function getTmpPath()
    {
        return $this->tmpPath;
    }

    /**
     * @param mixed $tmpPath
     */
    public function setTmpPath($tmpPath)
    {
        $this->tmpPath = $tmpPath;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }




    /**
     * @return bool
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param bool $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getCreation()
    {
        return $this->creation;
    }

    /**
     * @param mixed $creation
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;
    }

    /**
     * @return mixed
     */
    public function getModification()
    {
        return $this->modification;
    }

    /**
     * @param mixed $modification
     */
    public function setModification($modification)
    {
        $this->modification = $modification;
    }


    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * @return mixed
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * @param mixed $mime
     */
    public function setMime($mime)
    {
        $this->mime = $mime;
    }


   
    
}