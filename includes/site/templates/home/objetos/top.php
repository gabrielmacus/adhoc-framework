
<div class="grid">
<?php

$subsecciones = $secciones[$clasificadosSeccionId]->getSecciones();


echo json_encode($lang);
foreach ($subsecciones as $k=>$v)
{

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
