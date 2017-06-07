<div class="bloque-1">
    <?php
     foreach($dataToSkin as $k => $data)
    {

        
        $img =reset($data->getArchivos());
        if($img[$imgSize])
        {
         $img=$img[$imgSize];
        }
        else
        {
            $img=$img["original"];
        }

        ?>
       <div class="item-container">
           <article class="item">
               <figure class="image">
                   <img src="<?php echo $img->getRealName();?>">

               </figure>
               <h3 class="title">
                   <span class="text"><?php echo $data->getTitulo();?></span>
               </h3>
               <span class="tag">
                   <?php

                   var_dump($secciones);
                   $data->getSeccion();
                   ?>
               </span>
           </article>
       </div>
        <?php
    }
    ?>
</div>