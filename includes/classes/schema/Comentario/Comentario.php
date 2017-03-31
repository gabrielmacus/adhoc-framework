<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 23:50
 */
class Comentario
{
    protected $id;
    protected $texto;
    protected $creacion;
    protected $modificacion;
    protected $usuario;
    protected $respuesta=0;
    protected $deshabilitado;
    protected $post;


    function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
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
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * @param mixed $respuesta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    }

    /**
     * @return mixed
     */
    public function getDeshabilitado()
    {
        return $this->deshabilitado;
    }

    /**
     * @param mixed $deshabilitado
     */
    public function setDeshabilitado($deshabilitado)
    {
        $this->deshabilitado = $deshabilitado;
    }



}