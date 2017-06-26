
<div class="grid flex">
    <ul class="cell main-background-color menu flex">
        <li class="item flex">
            <a class="text">Parana te vende ya!</a>
        </li>

        <li class="item flex">
            <a data-fancybox="iframe" data-src="http://fancyapps.com/fancybox/3/iframe.html" data-type="iframe"  class="text">Ingresá</a>
        </li>
        <li class="item flex">
            <a class="text">Registrate</a>
        </li>

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
