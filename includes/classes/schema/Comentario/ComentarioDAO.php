<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 30/03/2017
 * Time: 23:51
 */
require_once "Comentario.php";
require_once "IComentario.php";
class ComentarioDAO implements IComentario
{
    protected $dataSource;
    protected $tableName;
    protected $comentarios;
    private $insertSql;
    private $updateSql;

    /**
     * UserDAO constructor.
     * @param $dataSource
     * @param $tableName
     */
    public function __construct(DataSource $dataSource, $tableName="comentarios")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;
        $this->insertSql="INSERT INTO  {$this->tableName} 
 (comentario_id,comentario_texto,comentario_creacion,comentario_modificacion,
 comentario_usuario,comentario_respuesta,comentario_deshabilitado,comentario_post)
 VALUES 
  (:comentario_id,:comentario_texto,:comentario_creacion,:comentario_modificacion,
 :comentario_usuario,:comentario_respuesta,:comentario_deshabilitado,:comentario_post)
 ";

        $this->updateSql="UPDATE {$this->tableName}  SET 
comentario_id=:comentario_id,comentario_texto=:comentario_texto,
comentario_creacion=:comentario_creacion,comentario_modificacion=:comentario_modificacion,
 comentario_usuario=:comentario_usuario,comentario_respuesta=:comentario_respuesta,
 comentario_deshabilitado=:comentario_deshabilitado WHERE comentario_id=:comentario_id";

    }



    public function insertComentario(Comentario $c)
    {
        $this->validate($c);

        $sql = $this->insertSql;

        if(!$c->getCreacion())
        {
            $c->setCreacion(time());
        }
        if(!$c->getModificacion())
        {
            $c->setModificacion(time());
        }




        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($c));
        return $res;
    }

    private function getParamsArray($c)
    {
        return    array(
            ":comentario_id"=>$c->getId(),
            ":comentario_texto"=>$c->getTexto(),
            ":comentario_creacion"=>$c->getCreacion(),
            ":comentario_modificacion"=>$c->getModificacion(),
            ":comentario_usuario"=>$c->getUsuario(),
            ":comentario_respuesta"=>$c->getRespuesta(),
            ":comentario_deshabilitado"=>$c->getDeshabilitado(),
            ":comentario_post"=>$c->getPost()
        );
    }
    private function query($data)
    {
       $c= new Comentario();
       $c->setId($data["comentario_id"]);
       $c->setCreacion($data["comentario_creacion"]);
       $c->setDeshabilitado($data["comentario_deshabilitado"]);
       $c->setModificacion($data["comentario_modificacion"]);
       $c->setRespuesta($data["comentario_respuesta"]);
       $c->setTexto($data["comentario_texto"]);
       $c->setUsuario($data["comentario_usuario"]);

       array_push($this->comentarios,$c);

    }



    public function selectComentarios()
    {
        $sql = "SELECT * FROM {$this->tableName}";

        $this->dataSource->runQuery($sql,array(),function($data){

            $this->query($data);

        });

        return $this->comentarios[0];
    }

    public function selectComentarioById($id)
    {

        $sql = "SELECT * FROM {$this->tableName} WHERE comentario_id=:comentario_id";

        $this->dataSource->runQuery($sql,array(":comentario_id"=>$id),function($data){
            $this->query($data);
        });

        return $this->comentarios[0];
    }

    public function updateComentario(Comentario $c)
    {
        $this->validate($c);

        $c->setModificacion(time());

        $sql = $this->updateSql;
        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($c));
        return $res;
    }

    public function deleteComentarioById($id)
    {

        $sql = "DELETE FROM {$this->tableName} WHERE comentario_id= :comentario_id";

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":comentario_id"=>$id
            ));
        return $res;
    }

    public function validate(Comentario $c)
    {
        // TODO: Implement validate() method.
    }




}