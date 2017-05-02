
<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 29/03/2017
 * Time: 1:32
 */


require_once ("Imagen.php");

class ImagenDAO extends ArchivoDAO
{
    public function __construct(DataSource $dataSource, $tableName = "archivos")
    {
        parent::__construct($dataSource, $tableName);
    }

    


    public function insertArchivo(IArchivo $i,$versionName="original",$versionId=0)
    {



        $originalSize = getimagesize($i->getTmpPath()) ;

        $i->setAlto($originalSize[1]);
        $i->setAncho($originalSize[0]);

       $original=  parent::insertArchivo($i);//Agrego el archivo original

        $files[]=$original;
        //get resoluciones del repositorio

    $r=    $i->getRepositorio();

  foreach ($r->getVersiones() as $version)
  {
      $version = $version["text"];

      $arr=array();

      $version = trim($version);
      $version = explode(":",$version);
      $arr["nombre"]=$version[0];
      $version = explode("x",$version[1]);
      $arr["ancho"]=$version[0];
      $arr["alto"]=$version[1];

      $resoluciones[]=$arr;
  }

        /*$resoluciones=array(
            array("ancho"=>300,"alto"=>300,"nombre"=>"portada"),
            array("ancho"=>200,"alto"=>200,"nombre"=>"thumbnail")
        );*/
        

        var_dump($resoluciones);
        
        foreach ($resoluciones as $resolucion)
        {
            $copy=$i->getTmpPath().".{$resolucion["nombre"]}";//Ruta del archivo a redimensionar

            if(!copy($i->getTmpPath(),$copy))
            {
                throw  new Exception("ImagenDAO:0");//Error al copiar archivo temporal;
            }
            $image =new \Eventviva\ImageResize($copy);

            $image->resizeToBestFit($resolucion["ancho"],$resolucion["alto"]); //Redimension

            $image->save($copy);

   

            $i->setTmpPath($copy); //Seteo la ruta temporal de la imagen a guardar

            $finalSize = getimagesize($copy) ;
            
            $i->setAlto($finalSize[1]);
            $i->setAncho($finalSize[0]);

            $files[]=parent::insertArchivo($i,$resolucion["nombre"],$original); 
        }

        return $files;

    }
   


}