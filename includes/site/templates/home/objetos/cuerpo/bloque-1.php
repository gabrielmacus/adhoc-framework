<div class="bloque-1">
    
    <?php

    $GLOBALS["postDAO"]->setOrderBy(" post_creacion ASC");

    var_dump(   $GLOBALS["postDAO"]->getOrderBy());
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



               <span class="tag animated" style="background-color: rgba(<?php echo $lang["secciones"][$data->getSeccion()]["color"];?>,0.25)">


                          <span style="" class="ribbon animated">
                            <span class="ribbon-text">

                                  <?php

                                  echo  $secciones[$data->getSeccion()]->getNombre();

                                  ?>
                            </span>
                              <span style=" background-color: rgba(<?php echo $lang["secciones"][$data->getSeccion()]["color"];?>,1)" class="animated ribbon-background"></span>
                          </span>

               </span>

           </article>
       </div>
        <?php
    }
    ?>
</div>