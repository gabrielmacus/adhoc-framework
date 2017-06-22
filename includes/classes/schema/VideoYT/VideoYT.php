<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 29/03/2017
 * Time: 1:30
 */
class VideoYT extends Archivo
{
    public function __construct($size, $name, $mime, $version, $realName, $tmpPath, $repositorio, $path, $creation, $modification, $id, $versionName, $type)
    {
        parent::__construct($size, $name, $mime, $version, $realName, $tmpPath, $repositorio, $path, $creation, $modification, $id, $versionName, 5);
    }


    function getId()
    {
        $url = $this->getRealName();
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        return $my_array_of_vars['v'];
    }

}