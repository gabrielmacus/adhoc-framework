
<div class="grid flex">
    <ul class="cell main-background-color">

        <li>Data</li>


    </ul>
<?php

$subsecciones = $secciones[$clasificadosSeccionId]->getSecciones();


foreach ($subsecciones as $k=>$v)
{

    $s = $lang["secciones"][$v->getId()];

    ?>
    <div class="cell overflow-hidden">
        <div class="mask fit animated">

        </div>
        <a>
            <figure class="fit valign flex center">
                <img class="fit " src="<?php echo $s["img"]?>">
                <figcaption>
                    <p>
                        <?php
                        if(!$s["text"])
                        {
                            $txt =$v->getNombre();
                        }
                        else
                        {
                            $txt= $s["text"];
                        }
                        echo $txt;
                        ?>
                    </p>
                </figcaption>
            </figure>
        </a>

       
    </div>
    <?php

}


?>
</div>
