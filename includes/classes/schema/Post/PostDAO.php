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
 post_seccion=:post_seccion,post_creacion=:post_creacion,post_modificacion=:post_modificacion,
  post_extra_1=:post_extra_1,post_extra_2=:post_extra_2,post_extra_3=:post_extra_3,post_extra_4=:post_extra_4 WHERE post_id=:post_id";

    }

  /*  public function insertAnexo(Post $p,Post $p2,$orden=0)
    {
        $sql="INSERT INTO post_nexos SET post__id='{$p->getId()}', SET post_b_id ='{$p2->getId()}',SET post_nexo_orden = '{$orden}'";
        
        return $this->dataSource->runUpdate($sql);
        
        
        // TODO: Implement insertAnexo() method.
    }
*/

    private function assocFiles(Post $p)
    {
        $archivos = $p->getArchivos();//Inserto los archivos adjuntos

        foreach ($archivos as  $archivo) {

            $archivo["objeto_id"]=$p->getId();

            if(!$archivo["delete"])
            {
                $archivosSql ="REPLACE INTO archivos_objetos SET ";

                $set="";
                foreach ($archivo as $k=>$v)
                {
                    $set.="{$k}='{$v}',";
                }

                $set=rtrim($set,",");

                $archivosSql.=" {$set}";

            }
            else
            {
                $archivosSql="DELETE FROM archivos_objetos WHERE archivo_objeto_id ='{$archivo["archivo_objeto_id"]}'";

            }


            $this->dataSource->runUpdate($archivosSql);

        }
    }

    private function assocAnexos(Post $p)
    {
        $anexos =$p->getAnexos();
        if(count($anexos)>0)
        {
            $sql="REPLACE INTO posts_nexos (post_nexo_id,post_id,post_anexo_id,post_nexo_orden) values ";

            $values ="";

            foreach ($anexos as $anexo)
            {

                if($anexo["delete"])
                {
                }
                else
                {
                    $values.=" ('{$anexo['post_nexo_id']}','{$p->getId()}','{$anexo['post_anexo_id']}','{$anexo['post_nexo_orden']}'),";

                }
            }

            $values = rtrim($values,",");

            $sql.="{$values}";

            $this->dataSource->runUpdate($sql);


        }
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

        $p->setId($this->dataSource->runUpdate($sql,
            $this->getParamsArray($p)));


        /** Codigo de asociacion de archivos**/
        $this->assocFiles($p);

        /*** **/

        /** ** Codigo de anexado */

        $this->assocAnexos($p);

        /** ** ****/

        return $p->getId();
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
    private function query($data,$byId=false)
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

        if(!$byId)
        {
            array_push($this->posts, $p);
        }
        else
        {
            $this->posts[$p->getId()]=$p;
        }


    }


    private  function processFiles($process=true)
    {
        $in = "0";
        foreach ($this->posts as $post) {

            $in.= ",{$post->getId()}";
        }

  /*      $joinArchivos = "SELECT * FROM archivos a RIGHT JOIN
 archivos_objetos ao ON   (a.archivo_id = ao.archivo_id OR a.archivo_version=ao.archivo_id) AND ao.objeto_tabla=:objeto_tabla AND ao.objeto_id IN ({$in}) ";
*/

  $joinArchivos="SELECT * FROM archivos_objetos ao LEFT JOIN archivos a ON (ao.archivo_id = a.archivo_id) WHERE ao.objeto_id IN ({$in})";
        //Traigo los archivos con todas sus versiones
        $archivos = $this->dataSource->runQuery($joinArchivos, array(

            ":objeto_tabla" => $this->tableName,

        ));


        foreach ($archivos as $archivo)
        {

            if(isset($archivo["objeto_id"]))
            {
                $p= $this->posts[$archivo["objeto_id"]];
                $nexo =array("archivo_objeto_id"=>$archivo["archivo_objeto_id"],
                    "archivo_grupo"=>$archivo["archivo_grupo"]);
                $postArchivos=$p->getArchivos();


                $idOriginal = $archivo["archivo_id"];
                if($archivo["archivo_id"]==0)
                {

                    $idOriginal=$archivo["archivo_version"];

                }
                $archivo= new Archivo($archivo["archivo_size"],
                    $archivo["archivo_name"],$archivo["archivo_mime"],
                    $archivo["archivo_version"],$archivo["archivo_real_name"],null,$archivo["archivo_repositorio"],$archivo["archivo_path"],
                    $archivo["archivo_creation"],$archivo["archivo_modification"],$archivo["archivo_id"],$archivo["archivo_version_name"],$archivo["archivo_type"]);

//                $postArchivos[$archivo->getType()][$idOriginal][$archivo->getVersionName()]=$archivo;

                $archivo->setNexo($nexo);

                //$postArchivos[$archivo->getType()][$archivo->getGaleria()][$idOriginal][$archivo->getVersionName()]=$archivo;
                $postArchivos[$nexo["archivo_grupo"]][$idOriginal][$archivo->getVersionName()]=$archivo;
                $p->setArchivos($postArchivos);

            }

        }

    }

    public function selectPostByTipo($tipo)
    {
        $this->posts=array();
        $sql = "SELECT * FROM {$this->tableName} WHERE post_seccion=:post_seccion";

        $this->dataSource->runQuery($sql,array(":post_seccion"=>$tipo),function($data){
            $this->query($data,true);
        });


        $this->processFiles();

        return $this->posts;
    }


    public function selectPosts()
    {
        $this->posts=array();
        $sql = "SELECT * FROM {$this->tableName} ";

        $this->dataSource->runQuery($sql, array(), function ($data) {

            $this->query($data, true);

        });

        $this->processFiles();


        return $this->posts;
    }

    public function selectPostById($id)
    {
        $this->posts=array();
        $sql = "SELECT * FROM {$this->tableName} WHERE post_id=:post_id";

        $this->dataSource->runQuery($sql,array(":post_id"=>$id),function($data){
            $this->query($data,true);
        });


        $this->processFiles();

        return array_values($this->posts)[0];
    }

    public function updatePost(Post $p)
    {

        $this->validate($p);

        $p->setModificacion(time());

        $sql = $this->updateSql;
        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($p));

        /** Codigo de asociacion de archivos**/
        $this->assocFiles($p);

        /*** **/

        /** ** Codigo de anexado */

        $this->assocAnexos($p);

        /** ** ****/

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