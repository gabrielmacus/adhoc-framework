<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/06/2017
 * Time: 03:04 PM
 */

include "includes/autoload.php";
$p=new PostDAO();

$post=$GLOBALS["postDAO"]->selectPostById(11);

foreach ($post->getAnexos() as $grupo)
{

    foreach ($grupo as $k=>$p)
    {

        echo $p->getId();

        echo "<br>";
    }

}
