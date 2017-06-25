<div class="mas-vistos flex">

    <header class="top main-color">
        <h2>Lo más visto</h2>
    </header>

    <div class="slider-wrapper">

        <div class="slider flex">

            <?php  for ($i=0;$i<9;$i++)
            {
                ?>
                <div class="image">
                    <figure>
                        <img class="fit" src="<?php echo $img[rand(0,(count($img)-1))];?>">
                    </figure>
                    <div class="mask" style="position: absolute;width: 100%;height: 100%;top:0;right:0;background-color: #0a0a0a;opacity: 0.3">

                    </div>
                </div>

                <?php
            }?>


        </div>
    </div>


</div>