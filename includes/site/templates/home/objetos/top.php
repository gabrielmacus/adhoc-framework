
<div class="grid flex">
    <div class="cell main-background-color">

    </div>
<?php

$subsecciones = $secciones[$clasificadosSeccionId]->getSecciones();


foreach ($subsecciones as $k=>$v)
{

    $s = $lang["secciones"][$v->getId()];

    ?>
    <div class="cell overflow-hidden">
        <div class="mask fit animated">

        </div>
        <figure class="fit">
            <img class="fit animated" src="<?php echo $s["img"]?>">
        </figure>
       
    </div>
    <?php

}


?>
</div>
