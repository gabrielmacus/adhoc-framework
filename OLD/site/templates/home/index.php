

<div class="top">
    <?PHP
    include "objetos/header.php";
    ?>
</div>


    <div class="body">


      

        <div class="col-1">

           <!-- <h2 class="header">Lo último...</h2>-->
            <?php

            /*
            $GLOBALS["postDAO"]->setOrderBy(" post_creacion DESC");
            $GLOBALS["postDAO"]->setLimit(9);
            $GLOBALS["postDAO"]->setActualPage(1);
            $imgSize="portada";
            $dataToSkin=$GLOBALS["postDAO"]->selectPostByTipo(84,false);
            */
            $bloqId=2;
            $bloque=$portada->getAnexos()[$bloqId];
            $sliderGroupId=1;
            $version="portada";


            include "objetos/cuerpo/bloque-1.php";

            ?>

        </div>


    </div>
