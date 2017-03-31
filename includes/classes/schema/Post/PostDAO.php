<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 31/03/2017
 * Time: 0:38
 */
require_once "IPost.php";
require_once "Post.php";
class PostDAO implements IPost
{


    protected $dataSource;
    protected $tableName;
    protected $posts=array();
    private $insertSql;
    private $updateSql;

    /**
     * UserDAO constructor.
     * @param $dataSource
     * @param $tableName
     */
    public function __construct(DataSource $dataSource, $tableName="posts")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;
        $this->insertSql="INSERT INTO  {$this->tableName} 
 (post_id,post_titulo,post_volanta,post_bajada,post_texto,post_etiquetas,
 post_seccion,post_creacion,post_modificacion,
 post_extra_1,post_extra_2,post_extra_3,post_extra_4)
 VALUES 
 (:post_id,:post_titulo,:post_volanta,:post_bajada,:post_texto,:post_etiquetas,
 :post_seccion,:post_creacion,:post_modificacion,
  :post_extra_1,:post_extra_2,:post_extra_3,:post_extra_4)";

        $this->updateSql="UPDATE {$this->tableName}  SET
post_id=:post_id,post_titulo=:post_titulo,
post_volanta=:post_volanta,post_bajada=:post_bajada,
post_texto=:post_texto,post_etiquetas=:post_etiquetas,
 post_seccion=:post_seccion,post_creacion=:post_creacion,post_modificacion=:post_modificacion
  post_extra_1=:post_extra_1,post_extra_2=:post_extra_2,post_extra_3=:post_extra_3,post_extra_4=:post_extra_4 WHERE post_id=:post_id";

    }



    public function insertPost(Post $p)
    {
        $this->validate($p);

        $sql = $this->insertSql;

        if(!$p->getCreacion())
        {
            $p->setCreacion(time());
        }

        if(!$p->getModificacion())
        {
            $p->setModificacion(time());
        }

        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($p));

        /** Codigo de asociacion de archivos**/

        $archivos = $p->getArchivos();//Inserto los archivos adjuntos

        $archivosSql ="INSERT INTO archivos_objetos (archivo_objeto_id,archivo_id,objeto_id,objeto_tabla,archivo_orden)
VALUES (:archivo_objeto_id,:archivo_id,:objeto_id,:objeto_tabla,:archivo_orden)";


       foreach ($archivos as  $archivo) {

           $this->dataSource->runUpdate($archivosSql,
               array(

                   ":archivo_objeto_id"=>$archivo["archivo_objeto_id"],
                   ":archivo_id"=>$archivo["archivo_id"],
                   ":objeto_id"=>$res,
                   ":objeto_tabla"=>$this->tableName,
                   ":archivo_orden"=>$archivo["archivo_orden"]

        ));

        }
        /*** **/


        return $res;
    }

    private function getParamsArray(Post $p)
    {
        return    array(
           ":post_id"=>$p->getId()
        ,":post_titulo"=>$p->getTitulo(),
        ":post_volanta"=>$p->getVolanta(),
        ":post_bajada"=>$p->getBajada(),
        ":post_texto"=>$p->getTexto(),
        ":post_etiquetas"=>$p->getEtiquetas(),
 ":post_seccion"=>$p->getSeccion(),
        ":post_creacion"=>$p->getCreacion(),
        ":post_modificacion"=>$p->getModificacion(),
            ":post_extra_1"=>$p->getExtra1(),
            ":post_extra_2"=>$p->getExtra2(),
            ":post_extra_3"=>$p->getExtra3(),
            ":post_extra_4"=>$p->getExtra4()
        );
    }
    private function query($data)
    {

        $p= new Post();

        $p->setId($data["post_id"]);
        $p->setTitulo($data["post_titulo"]);
        $p->setVolanta($data["post_volanta"]);
        $p->setBajada($data["post_bajada"]);
        $p->setTexto($data["post_texto"]);
        $p->setEtiquetas($data["post_etiquetas"]);
        $p->setSeccion($data["post_seccion"]);
        $p->setCreacion($data["post_creacion"]);
        $p->setModificacion($data["post_modificacion"]);
        $p->setExtra1($data["post_extra_1"]);
        $p->setExtra2($data["post_extra_1"]);
        $p->setExtra3($data["post_extra_1"]);
        $p->setExtra4($data["post_extra_1"]);
        array_push($this->posts, $p);

    }



    public function selectPosts()
    {
        $sql = "SELECT * FROM {$this->tableName} LEFT JOIN ";

        $this->dataSource->runQuery($sql,array(),function($data){

            $this->query($data);

        });

        $in="0";
        foreach ($this->posts as $post)
        {

            $in=",{$post["post_id"]}";
        }

        $joinArchivos ="SELECT * FROM archivos a LEFT JOIN
 archivos_objetos ao ON a.archivo_id = ao.archivo_id AND ao.objeto_tabla=:objeto_tabla AND ao.objeto_id IN (:objeto_id)";

        $this->dataSource->runQuery($joinArchivos,array(

            ":objeto_tabla"=>$this->tableName,
            ":objeto_id"=>$in

        ));


        return $this->posts;
    }

    public function selectPostById($id)
    {

        $sql = "SELECT * FROM {$this->tableName} WHERE post_id=:post_id";

        $this->dataSource->runQuery($sql,array(":post_id"=>$id),function($data){
            $this->query($data);
        });

        return $this->secciones[0];
    }

    public function updatePost(Post $p)
    {
        $this->validate($p);

        $sql = $this->updateSql;
        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($p));
        return $res;
    }

    public function deletePostById($id)
    {

        $sql = "DELETE FROM {$this->tableName} WHERE post_id= :post_id";

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":post_id"=>$id
            ));
        return $res;
    }

    public function validate(Post $p)
    {
        // TODO: Implement validate() method.
    }

}