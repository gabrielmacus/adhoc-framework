<div class="mas-vistos flex">

    <header class="top main-color">
        <h2>Lo más visto</h2>
    </header>

    <div class="slider-wrapper">

        <div class="slider-container">
            <div class="slider flex">

                <?php  for ($i=0;$i<9;$i++)
                {
                    ?>
                    <div class="image">
                        <figure>
                            <img class="fit" src="<?php echo $img[rand(0,(count($img)-1))];?>">
                        </figure>
                        <div class="mask main-background-color">
                            <div class="text">
                                <p>PICK UP BARATA OROCH DYNA 1.6 $ 57.100 y TASA BAJA O TASA 0%</p>
                            </div>
                        </div>
                    </div>

                    <?php
                }?>


            </div>
        </div>

    </div>


</div>