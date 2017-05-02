<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 01/05/2017
 * Time: 16:08
 */
class Documento extends Archivo
{
    public function __construct($size, $name, $mime, $version = null, $realName = null, $tmpPath = null, $repositorio, $path = null, $creation = null, $modification = null, $id = null, $versionName = null)
    {
        parent::__construct($size, $name, $mime, $version, $realName, $tmpPath, $repositorio, $path, $creation, $modification, $id, $versionName,4);
    }

}