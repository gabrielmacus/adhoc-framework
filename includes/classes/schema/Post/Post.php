<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 22:03
 */
class Post implements JsonSerializable
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
    protected $extra5;
    protected $extra6;
    protected $archivos=array();
    protected $anexos =array();
    protected $usuario;
    /** Variables para trabajar el post como anexos */
    
    protected $nexoId;
    protected $nexoGrupo;
    protected $nexoOrden;
    protected $anexoId;

    /**
     * @return mixed
     */
    public function getExtra5()
    {
        return $this->extra5;
    }

    /**
     * @param mixed $extra5
     */
    public function setExtra5($extra5)
    {
        $this->extra5 = $extra5;
    }

    /**
     * @return mixed
     */
    public function getExtra6()
    {
        return $this->extra6;
    }

    /**
     * @param mixed $extra6
     */
    public function setExtra6($extra6)
    {
        $this->extra6 = $extra6;
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
    public function getAnexoId()
    {
        return $this->anexoId;
    }

    /**
     * @param mixed $anexoId
     */
    public function setAnexoId($anexoId)
    {
        $this->anexoId = $anexoId;
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
    public function getNexoGrupo()
    {
        return $this->nexoGrupo;
    }

    /**
     * @param mixed $nexoGrupo
     */
    public function setNexoGrupo($nexoGrupo)
    {
        $this->nexoGrupo = $nexoGrupo;
    }

    /**
     * @return mixed
     */
    public function getNexoOrden()
    {
        return $this->nexoOrden;
    }

    /**
     * @param mixed $nexoOrden
     */
    public function setNexoOrden($nexoOrden)
    {
        $this->nexoOrden = $nexoOrden;
    }
    
    /** * */
    
    

    function __construct()
    {

    }

    function jsonSerialize()
    {
        return array(
            "titulo"=>$this->getTitulo(),
            "volanta"=>$this->getVolanta(),
            "bajada"=>$this->getBajada(),
            "texto"=>$this->getTexto(),
            "seccion"=>$this->getSeccion(),
            "creacion"=>$this->getCreacion(),
            "modificacion"=>$this->getModificacion(),
            "id"=>$this->getId(),
            "etiquetas"=>$this->getEtiquetas(),
            "comentarios"=>$this->getComentarios(),
            "extra1"=>$this->getExtra1(),
            "extra2"=>$this->getExtra2(),
            "extra3"=>$this->getExtra3(),
            "extra4"=>$this->getExtra4(),
            "archivos"=>$this->getArchivos(),
            "anexos"=>$this->getAnexos(),
            "nexoId"=>$this->getNexoId(),
            "nexoGrupo"=>$this->getNexoGrupo(),
            "nexoOrden"=>$this->getNexoOrden(),
            "anexoId"=>$this->getAnexoId(),
            "extra5"=>$this->getExtra5(),
            "extra6"=>$this->getExtra6()
        );
    }


    
    
    
    /**
     * @return array
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * @param array $anexos
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;
    }

    

    /**
     * @return array
     */
    public function getArchivos()
    {
        return $this->archivos;
    }

    /**
     * @param array $archivos
     */
    public function setArchivos($archivos)
    {
        $this->archivos = $archivos;
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