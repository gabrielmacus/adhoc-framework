<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 29/03/2017
 * Time: 1:30
 */
class VideoVM extends Archivo
{
    public function __construct($size, $name, $mime, $version, $realName, $tmpPath, $repositorio, $path, $creation, $modification, $id, $versionName, $type)
    {
        parent::__construct($size, $name, $mime, $version, $realName, $tmpPath, $repositorio, $path, $creation, $modification, $id, $versionName, 6);
    }


    function getVideoId()
    {
        $url = $this->getRealName();
        $url = explode("/",$url);
        
        return end($url);
    }

}