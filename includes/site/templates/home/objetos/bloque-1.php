
<header class="top main-color">
    <h2>Últimos clasificados</h2>

</header>


<div class="ultimos flex">

    <div class="body flex">

            <?php

            $img=["http://www.telegraph.co.uk/cars/images/2017/05/30/Swift-main-xlarge_trans_NvBQzQNjv4BqqFMKdkTGowzQxAKwkehuOGYSlEb08ZMNj4GyEOguAPo.jpg",
                "https://i.ytimg.com/vi/zPNWZox-xJ0/maxresdefault.jpg",
            "http://martjackstorage.azureedge.net/in-resources/bd5c1517-8d80-48d7-8e8e-365433ad124f/Images/userimages/Furniture/diningroom_1.jpg",
            "https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Left_side_of_Flying_Pigeon.jpg/300px-Left_side_of_Flying_Pigeon.jpg",
            "http://clasionce-media.elonce.com/2017/05/12/1494612350_118641_0_l.jpg"];

            for ($i=0;$i<9;$i++)
            {
            ?>
            <article class="item flex">
                <div class="shadow-2 flex">
                    <figure>
                        <img class="fit" src="<?php echo $img[rand(0,(count($img)-1))];?>">
                    </figure>
                    <div class="text">
                        <p>PICK UP BARATA OROCH DYNA 1.6 $ 57.100 y TASA BAJA O TASA 0%</p>
                    </div>
                    <footer class="pie main-background-color ">
                        <p class="flex" >
                            <span>$</span>
                            <span>
                        300
                    </span>
                        </p>
                    </footer>
                </div>

            </article>
                <?php
            }
            ?>

        </div>



</div>