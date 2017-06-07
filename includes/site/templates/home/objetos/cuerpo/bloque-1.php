<div class="bloque-1">
    <?php
    $arr =["http://elonce-media.elonce.com/fotos-nuevo/2017/05/29/s_1496079365.jpg","http://elonce-media.elonce.com/fotos-nuevo/2017/06/07/b_1496845430.jpg"];
    for ($i=0;$i<9;$i++)
    {
        ?>
        <article class="item">
            <figure>
                <img src="<?php echo $arr[rand(0,1)];?>">
            </figure>
        </article>
        <?php
    }
    ?>
</div>