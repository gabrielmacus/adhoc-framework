<div class="ultimos flex">

    <header class="top">
        <h2>Últimos clasificados</h2>
    </header>


        <div class="body flex">

            <?php

            $img=["http://clasionce-media.elonce.com/2016/12/16/1481895825_43968_0_l.jpg",
                "http://www.carsstories.com/wp-content/uploads/2017/05/car-searsh-sites.jpg",
            "http://clasionce-media.elonce.com/2017/06/22/1498184182_130682_0_l.jpg",
            "http://clasionce-media.elonce.com/2017/06/15/1497548787_20367_0_l.jpg"];

            for ($i=0;$i<6;$i++)
            {
            ?>
            <article class="item flex">
                <figure>
                    <img class="fit" src="<?php echo $img[rand(0,(count($img)-1))];?>">
                </figure>
                <div class="text">
                    <p>PICK UP BARATA OROCH DYNA 1.6 $ 57.100 y TASA BAJA O TASA 0%</p>
                </div>
            </article>
                <?php
            }
            ?>

        </div>



</div>