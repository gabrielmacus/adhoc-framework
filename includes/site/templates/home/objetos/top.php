
<div class="grid">
<?php

$subsecciones = $secciones[$clasificadosSeccionId]->getSecciones();



foreach ($subsecciones as $k=>$v)
{
    $s = $lang["secciones"][$k];

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
