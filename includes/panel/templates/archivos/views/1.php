
<?php

foreach ($archivos as $k=>$archivo)
{


    foreach ($archivo as $grupo)
    {



        foreach ($grupo as $versiones) {

            $version= reset($versiones);
var_dump($versiones["panel_repositorio"]);



            switch ($k)
            {
                case 0://Estandar
                    ?>

                    <div class="file-preview s12 m4 l3">
                        <input data-url="<?Php echo $version->getRealName();?>" data-name="<?php echo $version->getName()?>" data-id="<?php echo $versiones["original"]->getId()?>" style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div class="file">

                            <figure style=" text-align: center;padding-top: 11%;">
                                <i style="font-size: 150px" class="fa fa-file-o" aria-hidden="true"></i>

                            </figure>

                            <span class="name"><?php echo $version->getName()?></span>

                        <!--    <span class="size" ><?php echo  bytesToSize($version->getSize())?></span>
                        -->
                        </div>

                    </div>

                    <?php
                    break;

                case 1://Imagen
                    ?>

                    <div class="file-preview s12 m4 l3">
                        <input data-url="<?Php echo $version->getRealName();?>" data-name="<?php echo $version->getName()?>"   data-id="<?php echo $versiones["original"]->getId()?>" style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div  class="file">

                            <div class="mask animated">
                                <div class="half" >
                                    <a data-lity  href="<?php echo $version->getRealName()?>" class="icon">
                                        <i class="fa fa-search " aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="half"  >
                                    <a  download href="<?php echo $version->getRealName()?>" class="icon">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <figure>
                                <?php
                                $version= $versiones[$versionPanel];

                                ?>
                                <img data-ng-src="<?php echo $version->getRealName()?>">

                            </figure>

                            <span class="name"><?php echo $version->getName()?></span>
                        <!--
                            <span class="size" ><?php echo  bytesToSize($version->getSize())?></span>
                        -->
                        </div>

                    </div>

                    <?php
                    break;
                case 2://Video

                    ?>
                    <div class="file-preview s12 m4 l3">
                        <input data-url="<?Php echo $version->getRealName();?>"  data-id="<?php echo $versiones["original"]->getId()?>" data-name="<?php echo $version->getName()?>" style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div  class="file">

                            <figure>
                                <?php
                                $version= $versiones[$versionPanel];

                                ?>
                             <video>
                                 <source src="<?php echo $version->getRealName()?>">
                             </video>
                            </figure>

                            <span class="name"><?php echo $version->getName()?></span>
                           <!--
                            <span class="size" ><?php echo  bytesToSize($version->getSize())?></span>
                       -->
                        </div>

                    </div>
                    <?php

                    break;

                case 3://Audio

                    break;
                case 4:

                    ?>
                    <div class="file-preview s12 m4 l3">
                        <input data-url="<?Php echo $version->getRealName();?>" data-name="<?php echo $version->getName()?>"   data-id="<?php echo $versiones["original"]->getId()?>"  style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div  class="file">

                            <div class="mask animated">
                                <div class="half" >
                                    <a data-lity  href="http://docs.google.com/gview?url=<?php echo  $version->getRealName();?>&embedded=true" class="icon">
                                        <i class="fa fa-search " aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="half"  >
                                    <a  download href="<?php echo $version->getRealName()?>" class="icon">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <figure style=" text-align: center;padding-top: 11%;">
                                <i style="font-size: 150px" class="fa fa-file-o" aria-hidden="true"></i>

                            </figure>

                            <span class="name"><?php echo $version->getName()?></span>
                            <!--
                            <span class="size" ><?php echo  bytesToSize($version->getSize())?></span>
                        -->
                        </div>

                    </div>
                    <?Php
                    break;
            }


        }
    }
}

if(count($archivos)==0)
{
    ?>
    <div class="fila center" style="font-size: 40px;font-weight: 300;margin-top: 30px">
        <h3>No hay archivos en el repositorio</h3>
    </div>

    <?Php
}
?>


