<div class="bloque-1">
    <?php
    $arr =["http://elonce-media.elonce.com/fotos-nuevo/2015/10/22/s_1445526983.jpg","http://elonce-media.elonce.com/fotos-nuevo/2017/05/29/s_1496079365.jpg","http://elonce-media.elonce.com/fotos-nuevo/2017/06/07/b_1496845430.jpg"];
    for ($i=0;$i<6;$i++)
    {
        ?>
       <div class="item-container">
           <article class="item">
               <figure class="image">
                   <img src="<?php echo $arr[rand(0,count($arr)-1)];?>">

               </figure>
               <h3 class="title">
                   <span class="text">Cuenta regresiva para Tecnópolis Federal: capacitaron a los guías</span>
               </h3>
           </article>
       </div>
        <?php
    }
    ?>
</div>