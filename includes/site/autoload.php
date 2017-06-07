<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 17/05/2017
 * Time: 02:03 PM
 */


$lang=array_merge($lang,json_decode(file_get_contents(DIR_PATH."/includes/site/templates/comun/lang/{$configuracion->getLanguage()}.json"),true));
