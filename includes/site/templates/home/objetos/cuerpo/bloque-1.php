
<div class="bloque-1">
    
    <?php

     foreach($bloque as $k => $data)
    {
        $data = $GLOBALS["postDAO"]->selectPostById($data->getId());

        $img =reset($data->getArchivos()[$sliderGroupId]);
echo json_encode($data->getArchivos());
        echo "<br>";
        if($img)
        {
            if($img[$version])
            {
                $img=$img[$version];
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


    }
    ?>
</div>