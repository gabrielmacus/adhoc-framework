<div class="mas-vistos flex">

    <header class="top main-color">
        <h2>Lo más visto</h2>
    </header>

    <div class="slider-wrapper">

        <div class="slider">

            <?php  for ($i=0;$i<9;$i++)
            {
                ?>
                <figure>
                    <img class="fit" src="<?php echo $img[rand(0,(count($img)-1))];?>">
                </figure>
                <?php
            }?>

        </div>
    </div>


</div>