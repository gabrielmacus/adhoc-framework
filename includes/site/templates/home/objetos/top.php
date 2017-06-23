<?php
var_dump($secciones);

$subsecciones = $secciones[$clasificadosSeccionId]->getSecciones();



foreach ($subsecciones as $k=>$v)
{
    var_dump($v); 

}


?>