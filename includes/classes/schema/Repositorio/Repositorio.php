<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 28/03/2017
 * Time: 04:33 PM
 */

class Repositorio
{
    protected $host;
    protected $user;
    protected $pass;
    protected $port;
    protected $id;
    protected $name;
    protected $path;
    protected $creation;
    protected $modification;
    protected $files =array();
    
    public function __construct($host, $user, $pass,  $name, $path,$port=21, $creation=false,$modification=false,$id=false)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;
        $this->id = $id;
        $this->name = $name;
        $this->path = $path;
        $this->creation = $creation;
        $this->modification = $modification;
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

    
    
    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return boolean
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param boolean $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getPath()
    {
        return $this->path;
    }
    public function getDatePath()
    {
        $this->path= rtrim($this->path,"/");
        return   $this->path."/".date("Y/m/d",time())."/";
    }

    function getFtp()
    {
        $ftp = new \FtpClient\FtpClient();
        $ftp=$ftp->connect($this->getHost(),false,$this->getPort());
        $ftp=$ftp->login($this->getUser(),$this->getPass());

        return $ftp;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return boolean
     */
    public function getCreation()
    {
        return $this->creation;
    }

    /**
     * @param boolean $creation
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;
    }

    /**
     * @return boolean
     */
    public function getModification()
    {
        return $this->modification;
    }

    /**
     * @param boolean $modification
     */
    public function setModification($modification)
    {
        $this->modification = $modification;
    }

    

}