<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 31/03/2017
 * Time: 0:38
 */
require_once "IPost.php";
require_once "Post.php";

/**
 * Tipos de procesamiento anexos
 */
const SINGLE=1;
const RECURSIVE=2;
const NO_PROCESS=0;
class PostDAO  extends Paginable implements IPost
{



    protected $dataSource;
    protected $tableName;
    protected $posts=array();
    private $insertSql;
    private $updateSql;
    protected $orderBy;

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

    public function selectPostByTipoAndPertenece($tipo,$process=true,$processAnexos=true)
    {
        $this->posts=array();
        $sql = "SELECT * FROM {$this->tableName} WHERE post_seccion=:post_seccion ";

        $this->dataSource->runQuery($sql,array(":post_seccion"=>$tipo),function($data){
            $this->query($data,true);
        });

        /**** Proceso los anexos */

        $this->processAnexos($processAnexos);
        /*** **/

        $this->processFiles($process);

        return $this->posts;
    }

    public function setResults($where=false)
    {

        if (!$where)
        {
            $where="";
        }

        $sql="SELECT count(*) as 'total' FROM {$this->tableName} WHERE {$where}";


        $r=$this->dataSource->runQuery($sql)[0]['total'];

        parent::setResults($r);
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param mixed $orderBy
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    

    private function assocFiles(Post $p)
    {
        $archivos = $p->getArchivos();//Inserto los archivos adjuntos

        foreach ($archivos as  $k=>$archivo) {

            $archivo["objeto_id"]=$p->getId();
            $archivo["objeto_tabla"]=$this->tableName;

            if(!$archivo["delete"])
            {
                if(!$archivo["archivo_orden"])
                {
                    $archivo["archivo_orden"]=$k;
                }
                $archivosSql ="REPLACE INTO archivos_objetos SET ";

                $set="archivo_id={$archivo["archivo_id"]},
                objeto_id={$archivo["objeto_id"]},
                objeto_tabla='{$archivo["objeto_tabla"]}',
                archivo_grupo='{$archivo["archivo_grupo"]}',
                archivo_orden='{$archivo["archivo_orden"]}',archivo_objeto_id='{$archivo["archivo_objeto_id"]}'";

  /*              $set="";
                foreach ($archivo as $k=>$v)
                {
                    $set.="{$k}='{$v}',";
                }

                $set=rtrim($set,",");
*/
                $archivosSql.=" {$set}";

            }
            else
            {
                $archivosSql="DELETE FROM archivos_objetos WHERE archivo_id ='{$archivo["archivo_id"]}' AND  objeto_id ='{$archivo["objeto_id"]}' ";

            }


            $this->dataSource->runUpdate($archivosSql);

        }
    }

    private function assocAnexos(Post $p)
    {

        $anexos =$p->getAnexos();

        if(count($anexos)>0)
        {

            /**** Codigo provisorio, elimino los anexos y los vuelo a anexar TODO mejorar implementacion***/
            /*
            $sqlDelete="DELETE FROM posts_nexos WHERE post_id={$p->getId()} OR post_anexo_id ={$p->getId()}";
            $this->dataSource->runUpdate($sqlDelete);
            */

            /*** **/


            $sql="REPLACE INTO posts_nexos (post_nexo_id,post_id,post_anexo_id,post_nexo_grupo,post_nexo_orden) values ";

        //    $deleteAnexosSql="DELETE FROM posts_nexos WHERE post_nexo_id IN ";


            $values ="";

            foreach ($anexos as $k=> $anexo)
            {

                if($anexo["delete"])
                {
                    if($anexo["post_nexo_id"])
                    {

                        $sqlDelete="DELETE FROM posts_nexos 
               WHERE (post_id={$p->getId()}  AND post_anexo_id={$anexo["post_anexo_id"]})
                 OR (post_anexo_id={$p->getId()}  AND post_id={$anexo["post_anexo_id"]})";
                        $this->dataSource->runUpdate($sqlDelete);



                    }
                }
                else
                {

                    if(!$anexo["post_nexo_orden"])
                    {
                        $anexo["post_nexo_orden"]=$k;
                    }

                    /** Asocio objetos de manera bidireccional */
                    $id=$anexo["post_nexo_id"];
                    if(!$id)
                    {
                        $values.=" ('','{$p->getId()}','{$anexo['post_anexo_id']}','{$anexo["post_nexo_grupo"]}','{$anexo['post_nexo_orden']}'),";
                  //Asociacion bidireccional desactivada      $values.=" ('','{$anexo['post_anexo_id']}','{$p->getId()}','{$anexo["post_nexo_grupo"]}','{$anexo['post_nexo_orden']}'),";
                    }
                    else
                    {

                        $values.=" ('{$id}','{$p->getId()}','{$anexo['post_anexo_id']}','{$anexo["post_nexo_grupo"]}','{$anexo['post_nexo_orden']}'),";

                    }

                }
            }


            $values = rtrim($values,",");

            $sql.="{$values}";



            if($values!="")
            {     $this->dataSource->runUpdate($sql);


            }


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



            $p->setModificacion(time());


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
        $p->setExtra2($data["post_extra_2"]);
        $p->setExtra3($data["post_extra_3"]);
        $p->setExtra4($data["post_extra_4"]);

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

  //$joinArchivos="SELECT * FROM archivos_objetos ao LEFT JOIN archivos a ON (ao.archivo_id = a.archivo_id ) WHERE ao.objeto_id IN ({$in})";
        $joinArchivos="SELECT *,a.archivo_id as 'id'  FROM archivos_objetos ao LEFT JOIN archivos a ON (ao.archivo_id = a.archivo_id OR a.archivo_version=ao.archivo_id) WHERE ao.objeto_id IN ({$in})";



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
                    "archivo_grupo"=>$archivo["archivo_grupo"],"archivo_orden"=>$archivo["archivo_orden"]);
                $postArchivos=$p->getArchivos();


                $idOriginal = $archivo["id"];
                if($archivo["archivo_version"]!=0)
                {

                    $idOriginal=$archivo["archivo_version"];

                }
                $archivo= new Archivo($archivo["archivo_size"],
                    $archivo["archivo_name"],$archivo["archivo_mime"],
                    $archivo["archivo_version"],$archivo["archivo_real_name"],null,$archivo["archivo_repositorio"],$archivo["archivo_path"],
                    $archivo["archivo_creation"],$archivo["archivo_modification"],$archivo["archivo_id"],$archivo["archivo_version_name"],$archivo["archivo_type"]);

                $archivo->setNexoId($nexo["archivo_objeto_id"]);
                
//                $postArchivos[$archivo->getType()][$idOriginal][$archivo->getVersionName()]=$archivo;

                $archivo->setNexo($nexo);

                //$postArchivos[$archivo->getType()][$archivo->getGaleria()][$idOriginal][$archivo->getVersionName()]=$archivo;

                $archivo->setGrupo($nexo["archivo_grupo"]);//El grupo o galeria al que pertenece el archivo dentro del post

                /**
                 * 13.6.2017: Agregado orden
                 */

                if($process)
                {
                   // $postArchivos[$nexo["archivo_grupo"]][$idOriginal][$archivo->getVersionName()]=$archivo;
                    $postArchivos[$nexo["archivo_grupo"]][$nexo["archivo_orden"]][$archivo->getVersionName()]=$archivo;
                    
                }
                else
                {

                    $postArchivos[$nexo["archivo_orden"]][$archivo->getVersionName()]=$archivo;

                    //$postArchivos[$idOriginal][$archivo->getVersionName()]=$archivo;
                }


                /**
                 *
                 */

                $p->setArchivos($postArchivos);

            }

        }

    }

    public function selectPostByTipo($tipo,$process=true,$processAnexos=true)
    {
      $breadcrumb=  $GLOBALS["seccionDAO"]->selectCompleteSeccionBreadcrumb($tipo);

        $in="";
        foreach ($breadcrumb as $s)
        {
            $in.="{$s->getId()},";
        }


        $this->posts=array();

        $in.=$tipo;

        $where="post_seccion IN ({$in})";

        $sql = "SELECT * FROM {$this->tableName} WHERE {$where}";

        $orderBy=$this->getOrderBy();
        if($orderBy)
        {
            $sql.="  ORDER BY {$orderBy}";
        }


        $offset=$this->getOffset();

        if($this->getLimit())
        {
            $sql.="  LIMIT {$this->getLimit()} OFFSET {$offset}";
        }




        $this->dataSource->runQuery($sql,array(),function($data){
            $this->query($data,true);
        });


       // $sql = "SELECT * FROM {$this->tableName} WHERE post_seccion=:post_seccion";

        $this->setResults($where);

        /*
        $this->dataSource->runQuery($sql,array(":post_seccion"=>$tipo),function($data){
            $this->query($data,true);
        });*/

        /**** Proceso los anexos */

        $this->processAnexos($processAnexos);
        /*** **/
        $this->processFiles($process);

        return $this->posts;
    }

    /**
     * Proceso los anexos de manera recursiva de un post
     */
    private  function processRecursiveAnexos(&$posts,$process=true)
    {

        $in="";
        foreach ($this->posts as $post) {

            $in.= ",{$post->getId()}";
        }

        $anexosSql="SELECT p.*,n.* ,n.post_id as 'id' FROM `posts_nexos` n
 LEFT JOIN posts p ON p.post_id = n.post_anexo_id WHERE n.post_id IN (0{$in})
 ORDER BY post_nexo_orden ASC";

        $postAnexos =array();
        $anexos=  $this->dataSource->runQuery($anexosSql);

        foreach ($anexos as $anexo)
        {

            $post =new Post();
            $post->setTitulo($anexo["post_titulo"]);
            $post->setVolanta($anexo["post_volanta"]);
            $post->setBajada($anexo["post_bajada"]);
            $post->setTexto($anexo["post_texto"]);
            $post->setExtra1($anexo["post_extra_1"]);
            $post->setExtra2($anexo["post_extra_2"]);
            $post->setExtra3($anexo["post_extra_3"]);
            $post->setExtra4($anexo["post_extra_4"]);
            $post->setCreacion($anexo["post_creacion"]);
            $post->setModificacion($anexo["post_modificacion"]);
            $post->setId($anexo["id"]);
            $post->setNexoGrupo($anexo["post_nexo_grupo"]);
            $post->setNexoOrden($anexo["post_nexo_orden"]);
            $post->setNexoId($anexo["post_nexo_id"]);
            $post->setAnexoId($anexo["post_anexo_id"]);



            if($process)
            {
                $postAnexos[$anexo["post_nexo_grupo"]][]=$post;
            }
            else
            {
                $postAnexos[]=$post;
            }


            if($this->posts[$anexo["id"]])
            {
                $this->posts[$anexo["id"]]->setAnexos($postAnexos);
            }
            if($this->posts[$anexo["post_id"]])
            {
                $this->posts[$anexo["post_id"]]->setAnexos($postAnexos);
            }

            //  $this->posts[$anexo["objeto_id"]]->setAnexos($postAnexos);
        }

    }


    private function processAnexos($process=true)
{
    $in="";
    foreach ($this->posts as $post) {

        $in.= ",{$post->getId()}";
    }

    $anexosSql="SELECT p.*,n.* ,n.post_id as 'id' FROM `posts_nexos` n
 LEFT JOIN posts p ON p.post_id = n.post_anexo_id WHERE n.post_id IN (0{$in})
 ORDER BY post_nexo_orden ASC";

    $postAnexos =array();
    $anexos=  $this->dataSource->runQuery($anexosSql);

    foreach ($anexos as $anexo)
    {

        $post =new Post();
        $post->setTitulo($anexo["post_titulo"]);
        $post->setVolanta($anexo["post_volanta"]);
        $post->setBajada($anexo["post_bajada"]);
        $post->setTexto($anexo["post_texto"]);
        $post->setExtra1($anexo["post_extra_1"]);
        $post->setExtra2($anexo["post_extra_2"]);
        $post->setExtra3($anexo["post_extra_3"]);
        $post->setExtra4($anexo["post_extra_4"]);
        $post->setCreacion($anexo["post_creacion"]);
        $post->setModificacion($anexo["post_modificacion"]);
        $post->setId($anexo["post_anexo_id"]);
        $post->setNexoGrupo($anexo["post_nexo_grupo"]);
        $post->setNexoOrden($anexo["post_nexo_orden"]);
        $post->setNexoId($anexo["post_nexo_id"]);
        $post->setAnexoId($anexo["post_anexo_id"]);



        if($process)
        {
            $postAnexos[$anexo["post_nexo_grupo"]][]=$post;
        }
        else
        {
            $postAnexos[]=$post;
        }


        if($this->posts[$anexo["id"]])
        {
            $this->posts[$anexo["id"]]->setAnexos($postAnexos);
        }
        if($this->posts[$anexo["post_id"]])
        {
            $this->posts[$anexo["post_id"]]->setAnexos($postAnexos);
        }

        //  $this->posts[$anexo["objeto_id"]]->setAnexos($postAnexos);
    }

}

    public function selectPosts($process=true,$processAnexos=true)
    {
        $this->posts=array();
        
        $sql = "SELECT * FROM {$this->tableName}";

        $orderBy=$this->getOrderBy();
        if($orderBy)
        {
            $sql.="  ORDER BY {$orderBy}";
        }


        $this->setResults();

        $offset=$this->getOffset();

        if($this->getLimit())
        {
            $sql.="  LIMIT {$this->getLimit()} OFFSET {$offset}";
        }

        $this->dataSource->runQuery($sql, array(), function ($data) {

            $this->query($data, true);

        });

        

        /**** Proceso los anexos */

        $this->processAnexos($processAnexos);
        /*** **/
        $this->processFiles($process);


        return $this->posts;
    }

    public function selectPostById($id,$process=true,$processAnexos=SINGLE)
    {
        $this->posts=array();
        $sql = "SELECT * FROM {$this->tableName} WHERE post_id=:post_id";


        
            $this->dataSource->runQuery($sql,array(":post_id"=>$id),function($data){
                $this->query($data,true);
            });



        /**** Proceso los anexos */
        switch ($processAnexos)

        {
            case SINGLE:
                $this->processAnexos($processAnexos);
                break;

                case RECURSIVE:
                //DESHABILITADO POR AHORA
                //    $this->processRecursiveAnexos($this->posts,$processAnexos);
                    break;



        }
        /*** **/
        $this->processFiles($process);

        
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
        $sql="DELETE FROM archivos_objetos WHERE objeto_tabla=:objeto_tabla AND objeto_id=:objeto_id";

        $res= $this->dataSource->runUpdate($sql,array(
            ":objeto_tabla"=>$this->tableName,
            ":objeto_id"=>$id
        ));

        $sql="DELETE FROM posts_nexos WHERE post_anexo_id=:post_anexo_id OR post_id=:post_id";

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":post_anexo_id"=>$id,
                ":post_id"=>$id
            ));


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