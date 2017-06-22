
<?php


foreach ($archivos as $k=>$archivo)
{


    foreach ($archivo as $grupo)
    {


        foreach ($grupo as $versiones) {


            $version= reset($versiones);

            if(!$versiones[$versionPanel])//Si no encuentro la version de panel, cargo la original
            {
                $vp="original";
            }
            else
            {
                $vp=$versionPanel;
            }


            switch ($k)
            {
                case 0://Estandar
                    ?>

                    <div class="file-preview s12 m4 l3">
                        <input data-url="<?Php echo $version->getRealName();?>" data-name="<?php echo $version->getName()?>" data-id="<?php echo $versiones["original"]->getId()?>" style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div class="file">
                            <div class="mask animated">

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

                        <!--    <span class="size" ><?php echo  bytesToSize($version->getSize())?></span>
                        -->
                        </div>

                    </div>

                    <?php
                    break;

                case 1://Imagen

                    $version= $versiones[$vp];

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
                            <figure>
                                <?php
                                $version= $versiones[$vp];

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

                    ?>
                    <div class="file-preview s12 m4 l3">
                        <input data-url="<?Php echo $version->getRealName();?>" data-name="<?php echo $version->getName()?>"   data-id="<?php echo $versiones["original"]->getId()?>" style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div  class="file">
                            <figure class="center">
                                <i style="    font-size: 150px;
    top: 15%;
    position: relative;
    z-index: 0;" class="fa fa-music" aria-hidden="true"></i>

                            </figure>
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


                            <span class="name"><?php echo $version->getName()?></span>
                            <!--
                            <span class="size" ><?php echo  bytesToSize($version->getSize())?></span>
                        -->
                        </div>

                    </div>
                    <?php

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
                case 5:
                    ?>
                    <div class="file-preview s12 m4 l3">
                        <input data-url="<?Php echo $version->getRealName();?>" data-name="<?php echo $version->getName()?>"   data-id="<?php echo $versiones["original"]->getId()?>"  style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div  class="file">

                            <div class="mask animated" style="z-index: 100">
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
                            <figure style=" text-align: center;padding-top: 11%;background-image: url('<?php echo $version->getPath();?>');background-repeat: no-repeat;-webkit-background-size: ;background-size: cover;">
                                <i style="font-size: 150px;color: rgba(225, 62, 69, 1);    position: relative;
    font-size: 80px;
    top: 20%;" class="fa fa-youtube-play" aria-hidden="true"></i>


                            </figure>

                            <span class="name"><?php echo $version->getName()?></span>
                            <!--
                            <span class="size" ><?php echo  bytesToSize($version->getSize())?></span>
                        -->
                        </div>

                    </div>
                    <?php

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


