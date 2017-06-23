
<div class="grid">
<?php

$subsecciones = $secciones[$clasificadosSeccionId]->getSecciones();



foreach ($subsecciones as $k=>$v)
{
    var_dump($lang);
    $s = $lang["secciones"][$v->getId()];

    ?>
    <div class="cell">
        <figure>
            <img src="<?php echo $s["img"]?>">
        </figure>
    </div>
    <?php

}


?>
</div>
