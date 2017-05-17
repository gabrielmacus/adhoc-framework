<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 23:14
 */

class Idioma implements JsonSerializable
{
    protected $id;
    protected $nombre;
    protected $short;
    protected $predeterminado=0;

    function __construct()
    {
    }

    /**
     * @return boolean
     */
    public function isPredeterminado()
    {
        return $this->predeterminado;
    }

    /**
     * @param boolean $predeterminado
     */
    public function setPredeterminado($predeterminado)
    {
        $this->predeterminado = $predeterminado;
    }

    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getShort()
    {
        return $this->short;
    }

    /**
     * @param mixed $short
     */
    public function setShort($short)
    {
        $this->short = $short;
    }

  
    
    function jsonSerialize()
    {
        return array(
            "id"=>$this->getId(),
            "name"=>$this->getNombre(),
            "short"=>$this->getShort(),
            "predeterminado"=>$this->isPredeterminado()
        );
    }
}