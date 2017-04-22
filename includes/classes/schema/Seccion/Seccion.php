<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 23:14
 */

class Seccion implements JsonSerializable
{
    protected $id;
    protected $nombre;
    protected  $tipo=0;
    protected $secciones=array();
    function __construct()
    {
    }

    /**
     * @return array
     */
    public function getSecciones()
    {
        return $this->secciones;
    }

    /**
     * @param array $secciones
     */
    public function setSecciones($secciones)
    {
        $this->secciones = $secciones;
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
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }


    function jsonSerialize()
    {
        return array(
            "id"=>$this->getId(),
            "nombre"=>$this->getNombre(),
            "tipo"=>$this->getTipo()
        );
    }
}