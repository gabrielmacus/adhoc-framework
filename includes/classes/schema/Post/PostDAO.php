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


    private $fields=array("post_id","post_titulo","post_volanta","post_bajada","post_texto","post_etiquetas",
       "post_seccion","post_creacion","post_modificacion",
        "post_extra_1","post_extra_2","post_extra_3","post_extra_4","post_usuario","post_extra_5","post_extra_6");

    protected $dataSource;
    protected $tableName;
    protected $posts=array();
    private $insertSql;
    private $updateSql;
    protected $orderBy;
    /**
     * @var array
     *
     *
     *
     */
    protected $filters=array();


    /**
     * UserDAO constructor.
     * @param $dataSource
     * @param $tableName
     */
    public function __construct(DataSource $dataSource, $tableName="posts")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;


        /**
         * 14.6.2017 : Agregada funcionalidad para mapear los campos en la consulta de manera mas transparente
         */

      $this->generateSql();

    }

    private function generateSql()
    {

        $fields=implode(",",$this->fields);

        $fields2 = array_map(function($column) {
            return ":{$column}";
        }, $this->fields);

        $fields2=implode(",",$fields2);

        $this->insertSql="INSERT INTO  {$this->tableName} 
 ({$fields})
 VALUES 
 ({$fields2})";


        $fields = array_map(function($column) {
            return "{$column}=:{$column}";
        }, $this->fields);

        $fields=implode(",",$fields);

        $this->updateSql="UPDATE {$this->tableName}  SET
{$fields} WHERE post_id=:post_id";
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

    public function setResultsCount($sql)
    {
        $sql="SELECT count(*) as 'total' FROM ({$sql}) as tabla";

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
                /** 21.06.2017 Fixed**/
               // $archivosSql="DELETE FROM archivos_objetos WHERE archivo_id ='{$archivo["archivo_id"]}' AND  objeto_id ='{$archivo["objeto_id"]}' ";
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
            ":post_extra_4"=>$p->getExtra4(),
            ":post_extra_5"=>$p->getExtra5(),
            ":post_extra_6"=>$p->getExtra6(),
            ":post_usuario"=>$p->getUsuario()
            
            
            
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
        $p->setExtra5($data["post_extra_5"]);
        $p->setExtra6($data["post_extra_6"]);
        $p->setUsuario($data["post_usuario"]);

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
        $joinArchivos="SELECT *,a.archivo_id as 'id'  FROM archivos_objetos ao LEFT JOIN archivos a ON (ao.archivo_id = a.archivo_id OR a.archivo_version=ao.archivo_id) WHERE ao.objeto_id IN ({$in}) ORDER BY archivo_orden";



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

                $archivo->setOrden($nexo["archivo_orden"]);

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
        $post->setExtra5($anexo["post_extra_5"]);
        $post->setExtra6($anexo["post_extra_6"]);
        $post->setCreacion($anexo["post_creacion"]);
        $post->setModificacion($anexo["post_modificacion"]);
        $post->setEtiquetas($anexo["post_etiquetas"]);
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

    public function _selectPosts($process=true,$processAnexos=true)
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

    /**
     * @return mixed
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param mixed $filters
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }

    public function selectPosts($processArchivos=true,$processAnexos=true)
    {
        $this->posts=array();

        //$sql = "SELECT * FROM {$this->tableName}";
        //TODO



        $fields="p.*";

        $where="";


        /** 14.6.2017 Filtrado **/
        $filters =$this->getFilters();


        /** Filtro por  archivos **/

        if($filters["archivos"])
        {
            //Cantidad de archivos
            $archivosWhere="";

            $fields.=",count(archivos_filter.objeto_id) as 'total_archivos'";

            $where.= (empty($where))?" WHERE total_archivos {$filters['archivos']}":" AND total_archivos {$filters['archivos']}";

            //Tipos de archivos
            if(is_array($filters["archivosExtensions"]))
            {
                $filters["archivosExtensions"] = array_map(function($column) {
                    return "'{$column}'";
                },   $filters["archivosExtensions"]);

                $filters["archivosExtensions"]=implode(",",$filters["archivosExtensions"]);

                $archivosWhere.=" WHERE a.archivo_extension IN ({$filters["archivosExtensions"]})";
            }

            $archivosFilterSql=" LEFT JOIN 

(SELECT ao.* FROM `archivos_objetos` ao LEFT JOIN archivos a ON a.archivo_id= ao.archivo_id {$archivosWhere}) as archivos_filter 

ON archivos_filter.objeto_id= p.post_id ";
        }

        /**  Filtro por anexos  **/

        //Cantidad de anexos

        if($filters["anexos"])
        {

            $anexosWhere="";

            $fields.=",count(posts_filter.post_id) as 'total_anexos'";

            $where.= (empty($where))?" WHERE total_anexos {$filters['anexos']}":" AND total_anexos {$filters['anexos']}";

            //Tipos de archivos
            if(is_array($filters["anexosTypes"]))
            {
                $filters["anexosTypes"] = array_map(function($column) {
                    return "'{$column}'";
                },   $filters["anexosTypes"]);

                $filters["anexosTypes"]=implode(",",$filters["anexosTypes"]);

                $anexosWhere.=" WHERE post_seccion IN ({$filters["anexosTypes"]})";
            }



            $anexosFilterSql="LEFT JOIN 

(SELECT pn.* FROM `posts_nexos` pn LEFT JOIN posts pt ON pt.post_id= pn.post_anexo_id {$anexosWhere}) as posts_filter

ON posts_filter.post_id = p.post_id";

        }


        //Filtro por seccion
        if(is_array($filters["seccion"]))
        {
            $filters["seccion"] =  implode(",",$filters["seccion"]);
        $where.= (empty($where))?" WHERE post_seccion IN ({$filters["seccion"]})":" AND  post_seccion IN ({$filters["seccion"]})";

        }

        //Filtro por palabras

        $qFilter="";
        if($filters["q"])
        {

            $qFilter.= (empty($qFilter))?"  WHERE MATCH (
                post_titulo,post_volanta,post_bajada,post_texto,post_etiquetas
            )
AGAINST (
    '{$filters["q"]}'
IN BOOLEAN MODE
)":" AND WHERE MATCH (
                post_titulo,post_volanta,post_bajada,post_texto,post_etiquetas
            )
AGAINST (
    '{$filters["q"]}'
IN BOOLEAN MODE
) ";



        }


        //Filtro por elementos excluidos

        if($filters["exclude"])
        {
            $exclude = implode(",",$filters["exclude"]);

            $qFilter.= (empty($qFilter))?"  WHERE post_id NOT IN ({$exclude}) ":" AND post_id NOT IN ({$exclude}) ";


        }



        /*** **/


        $subQuery="SELECT {$fields} FROM {$this->tableName} p {$archivosFilterSql} {$anexosFilterSql} {$qFilter} GROUP BY p.post_id";

   
        
        $sql = "SELECT * FROM ({$subQuery}) as tabla {$where}";



        $orderBy=$this->getOrderBy();
        if($orderBy)
        {
            $sql.="  ORDER BY {$orderBy}";
        }



        /** Pagino */
        $this->setResultsCount($sql);

        $offset=$this->getOffset();

        if($this->getLimit())
        {
            $sql.="  LIMIT {$this->getLimit()} OFFSET {$offset}";
        }
        /**  * */

        $this->dataSource->runQuery($sql, array(), function ($data) {

            $this->query($data, true);

        });



        /**** Proceso los anexos */

        $this->processAnexos($processAnexos);
        /*** **/
        $this->processFiles($processArchivos);


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