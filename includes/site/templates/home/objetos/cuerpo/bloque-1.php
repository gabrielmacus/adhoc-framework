
<div class="bloque-1">
    
    <?php

    echo "NO FILES";
  
     foreach($dataToSkin as $k => $data)
    {
        $img =reset($data->getArchivos());

        if($img)
        {
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
                              <span style=" background-color: rgba(<?php echo $lang["secciones"][$data->getSeccion()]["color"];?>,0.5)" class="animated ribbon-background"></span>
                          </span>

               </span>

                </article>
            </div>
            <?php
        }
        else
        {
            echo json_encode($data->getArchivos());
        }


    }
    ?>
</div>