

<div class="top">
    <?PHP
    include "objetos/header.php";
    ?>
</div>


    <div class="body">


      

        <div class="col-1">

            <?php

            $dataToSkin=$GLOBALS["postDAO"]->selectPosts();
            var_dump($dataToSkin);
            include "objetos/cuerpo/bloque-1.php";

            ?>

        </div>


    </div>
