<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 04/01/2017
 * Time: 04:49 PM
 */
/**
 * @param $r | repositorio
 * @return mixed
 */
function uploadTmp($r)
{
    foreach ($_POST["previews"] as $file)
    {

        $file["tmp"]=DIR_PATH.$file["tmp"];


        switch ($file["type"])
        {
            default:


                $a = new Archivo($file["size"],$file["name"],$file["mime"]);

                $a->setTmpPath($file["tmp"]);
                $a->setExtension($file["type"]);
                $a->setRepositorio($r);
                $res= $GLOBALS["archivoDAO"]->insertArchivo($a);
                $_POST["archivos"][]=array("archivo_id"=>$res[0],"objeto_tabla"=>"posts");//Para subida directa

                break;


            case "svg":
            case "jpeg":
            case "bmp":
            case "png":
            case "gif":
            case "jpg":


                $a = new Imagen($file["size"],$file["name"],$file["mime"]);
                $a->setTmpPath($file["tmp"]);
                $a->setExtension($file["type"]);
                $a->setRepositorio($r);
                $res= $GLOBALS["imagenDAO"]->insertArchivo($a);
            $_POST["archivos"][]=array("archivo_id"=>$res[0],"objeto_tabla"=>"posts");//Para subida directa

            break;

            case "pdf"://Documentos
            case "docx":
            case "odt":
            case "xls":
            case "docm":
            case "dot":
            case "dotx":
            case "html":
            case "htm":
            case "rtf":
            case "xps":
            case "xlsx":
            case "xltm":
            case "pptx":
            case "ppt":
            case "pptm":

            $a = new Documento($file["size"],$file["name"],$file["mime"]);
            $a->setTmpPath($file["tmp"]);
            $a->setExtension($file["type"]);
            $a->setRepositorio($r);
            $res= $GLOBALS["archivoDAO"]->insertArchivo($a);
            $_POST["archivos"][]=array("archivo_id"=>$res[0],"objeto_tabla"=>"posts");//Para subida directa

            break;

        }

    }
    return $res;
}
function isImage($path)
{
    return getimagesize($path)?true:false;//Chequeo si es una imagen
}

function readTemplate($name)
{
    return file_get_contents("includes/templates/".$name);
}


/**
 * Convert bytes to human readable format
 *
 * @param integer bytes Size in bytes to convert
 * @return string
 */
function bytesToSize($bytes, $precision = 2)
{
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;

    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';

    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';

    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';

    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';

    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}

function deleteDir($dir,$config)
{

// establecer una conexión b�sica
    $conn_id = ftp_connect($config["server"]);

// iniciar sesi�n con nombre de usuario y contrase�a
    $login_result = ftp_login($conn_id, $config["user"], $config["pass"]);

    ftp_pasv($conn_id,true);


    if($login_result)
    {
        ftp_chdir($conn_id, $dir);
        $files = ftp_nlist($conn_id, ".");
        $success=true;
        foreach ($files as $file)
        {

           if(!ftp_delete($conn_id, $file))
           {
               $success=false;
           }

        }

        return $success;


    } else
    {
        return false;
    }
}
function deleteFile($file,$config)
{


// establecer una conexión b�sica
    $conn_id = ftp_connect($config["server"]);

// iniciar sesi�n con nombre de usuario y contrase�a
    $login_result = ftp_login($conn_id, $config["user"], $config["pass"]);

    ftp_pasv($conn_id,true);


    if($login_result)
    {


        return ftp_delete($conn_id,$file);



    } else
{
   return false;
}

}


function uploadFiles($files,$dir,$config)
{

    if(trim($dir)=="/")
    {
        $dir="";
    }

    $ret["success"]=false;
    $ret["error"]=false;
// establecer una conexión b�sica
    $conn_id = ftp_connect($config["server"],21,120);

// iniciar sesi�n con nombre de usuario y contrase�a



    $login_result = ftp_login($conn_id, $config["user"], $config["pass"]);

    ftp_pasv($conn_id,true);


    if($login_result)
    {
        //creo los directorios

        if(count($files)>0)
        {
            $completeDir=$config["root_dir"].$dir;


            $dirs=explode("/",$completeDir);
            $dirToMake="";
            for($i=0;$i<count($dirs);$i++)
            {
                $dirToMake.="/{$dirs[$i]}";

                @ftp_mkdir($conn_id,$dirToMake);
            }


            foreach($files as $file)
            {




                $type = explode(".",$file["name"]);
                $type = $type[count($type)-1];//extension

                //Si tiene un solo formato
                if(!is_array($config["formats"]))
                {
                    $config["formats"]=array($config["formats"]);
                }

                



                if(   in_array($type, $config["formats"]))
                {
                    $tmpFile =$file["tmp_name"];


                   // $name =time()."_".$file["name"];

                    $name=time().".{$type}";
                    $originalName=$file["name"];
                    @ftp_mkdir($conn_id,$completeDir."/".$name);


                    $folder=$completeDir."/".$name;

                    $completeName= $folder."/o_".$name;//Se indica el prefijo o para los archivos originales


                    //creo las dimensiones dadas
                   // $config["sizes"]=explode(";", $config["sizes"]);

                    // cargo el archivo original

                    /*
                    var_dump($completeName);
                    var_dump($tmpFile) ;*/
                    if (ftp_put($conn_id,$completeName, $tmpFile, FTP_BINARY)) {


                        $file["sizes"]["o"]["completeUrl"]=$config["dns"].str_replace($config["root_dir"],"",$completeName);









                        $file["ext"]=explode(".",$originalName);

                        $file["ext"]=$file["ext"][count($file["ext"])-1];
                        $type=explode("/",$file["type"])[0];
                        if($type=="image")
                        {

                            //tamano de panel
                               $completeName= $folder."/p_".$name;//Se indica el prefijo o para los archivos originales


                            $image = new \Eventviva\ImageResize($tmpFile);



                            $panelRes = explode(",",$config["panelSize"]);




                            $image->resizeToBestFit(intval($panelRes[0]), intval($panelRes[1]));
                            $image->save($tmpFile);

                            if (ftp_put($conn_id,$completeName, $tmpFile, FTP_BINARY)) {
                                $file["sizes"]["p"]["completeUrl"]=$config["dns"].str_replace($config["root_dir"],"",$completeName);
                            }
                            else
                            {
                                $ret["error"][]=$file["name"];
                            }




                            //TODO copiar el archivo para mas de un resize

                            foreach($config["sizes"] as $k=>$size)
                            {

                                if($size)
                                {
                                    $copyFile=$tmpFile."_".$k;
                                    copy($tmpFile,$copyFile);

                                    $size= explode(",",$size);

                                    $completeName= $folder."/{$k}_".$name;//Se indica el prefijo o para los archivos originales

                                    $image = new \Eventviva\ImageResize($copyFile);
                                    $image->resizeToBestFit($size[0], $size[1]);
                                    $image->save($copyFile);

                                    if (ftp_put($conn_id,$completeName, $copyFile, FTP_BINARY)) {
                                        $file["sizes"][$k]["completeUrl"]=$config["dns"].str_replace($config["root_dir"],"",$completeName);



                                    }
                                    else
                                    {
                                        $ret["error"][]=$file["name"];
                                    }

                                }




                            }




                        }




                        $file["folder"]=$folder;
                        $file["name"]=$name;
                        $file["originalName"]=$originalName;
                        $file["date"]=time();


                        unset($file["tmp_name"]);

                        $ret["success"][]=$file;




                    } else {
                        $ret["error"][]=$file["name"];
                    }





                }
                else
                {
                    $ret["error"][]=$file["name"];

                }





            }
        }
        else{
            $ret["error"]=true;
        }


    }
    else
    {
        $ret["error"]=true;
    }

    ftp_close($conn_id);
    return $ret;



}

