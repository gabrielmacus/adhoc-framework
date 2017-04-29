<?php

foreach ($archivos as $k=>$archivo)
{


    foreach ($archivo as $grupo)
    {



        foreach ($grupo as $versiones) {

            $version= reset($versiones);




            switch ($k)
            {
                case 0://Estandar

                    break;

                case 1://Imagen
                    ?>

                    <div class="file-preview s6 m4 l3">
                        <input style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div data-ng-click="deletePreview(p)" class="file">

                            <figure>
                                <?php
                                $version= $versiones[$versionPanel];

                                ?>
                                <img data-ng-src="<?php echo $version->getRealName()?>">

                            </figure>

                            <span class="name"><?php echo $version->getName()?></span>
                            <span class="size" ><?php echo  bytesToSize($version->getSize())?></span>
                        </div>

                    </div>

                    <?php
                    break;
                case 2://Video

                    break;

                case 3://Audio

                    break;
            }


        }
    }
}
?>