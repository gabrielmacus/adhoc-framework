<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 22:03
 */
class Post
{
    protected $titulo;
    protected $volanta;
    protected $bajada;
    protected $texto;
    protected $etiquetas;
    protected $seccion;
    protected $creacion;
    protected $modificacion;
    protected $id;
    protected $comentarios=array();
    protected $extra1;
    protected $extra2;
    protected $extra3;
    protected $extra4;

    function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getExtra1()
    {
        return $this->extra1;
    }

    /**
     * @param mixed $extra1
     */
    public function setExtra1($extra1)
    {
        $this->extra1 = $extra1;
    }

    /**
     * @return mixed
     */
    public function getExtra2()
    {
        return $this->extra2;
    }

    /**
     * @param mixed $extra2
     */
    public function setExtra2($extra2)
    {
        $this->extra2 = $extra2;
    }

    /**
     * @return mixed
     */
    public function getExtra3()
    {
        return $this->extra3;
    }

    /**
     * @param mixed $extra3
     */
    public function setExtra3($extra3)
    {
        $this->extra3 = $extra3;
    }

    /**
     * @return mixed
     */
    public function getExtra4()
    {
        return $this->extra4;
    }

    /**
     * @param mixed $extra4
     */
    public function setExtra4($extra4)
    {
        $this->extra4 = $extra4;
    }



    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getVolanta()
    {
        return $this->volanta;
    }

    /**
     * @param mixed $volanta
     */
    public function setVolanta($volanta)
    {
        $this->volanta = $volanta;
    }

    /**
     * @return mixed
     */
    public function getBajada()
    {
        return $this->bajada;
    }

    /**
     * @param mixed $bajada
     */
    public function setBajada($bajada)
    {
        $this->bajada = $bajada;
    }

    /**
     * @return mixed
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param mixed $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * @return mixed
     */
    public function getEtiquetas()
    {
        return $this->etiquetas;
    }

    /**
     * @param mixed $etiquetas
     */
    public function setEtiquetas($etiquetas)
    {
        $this->etiquetas = $etiquetas;
    }

    /**
     * @return mixed
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * @param mixed $seccion
     */
    public function setSeccion($seccion)
    {
        $this->seccion = $seccion;
    }

    /**
     * @return mixed
     */
    public function getCreacion()
    {
        return $this->creacion;
    }

    /**
     * @param mixed $creacion
     */
    public function setCreacion($creacion)
    {
        $this->creacion = $creacion;
    }

    /**
     * @return mixed
     */
    public function getModificacion()
    {
        return $this->modificacion;
    }

    /**
     * @param mixed $modificacion
     */
    public function setModificacion($modificacion)
    {
        $this->modificacion = $modificacion;
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
     * @return array
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * @param array $comentarios
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
    }



}