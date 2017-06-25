<div class="mas-vistos flex">

    <header class="top main-color">
        <h2>Lo más visto</h2>
    </header>

    <div class="slider-wrapper">

        <div class="slider-container flex">

                <?php  for ($i=0;$i<9;$i++)
                {
                    ?>
                    <div class="image">
                        <figure>
                            <img class="fit" src="<?php echo $img[rand(0,(count($img)-1))];?>">
                        </figure>

                        <div class="mask main-background-color">

                        </div>
                    </div>

                    <?php
                }?>


        </div>

    </div>


</div>