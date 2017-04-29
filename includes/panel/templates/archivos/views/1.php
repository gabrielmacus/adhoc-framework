
<script>
    //For example we are defining menu in object. You can also define it on Ul list. See on documentation.
    var menu = [{
        name: 'create',
        img: 'images/create.png',
        title: 'create button',
        fun: function () {
            alert('i am add button')
        }
    }, {
        name: 'update',
        img: 'images/update.png',
        title: 'update button',
        fun: function () {
            alert('i am update button')
        }
    }, {
        name: 'delete',
        img: 'images/delete.png',
        title: 'delete button',
        fun: function () {
            alert('i am delete button')
        }
    }];

    //Calling context menu
    $('.file-preview').contextMenu(menu);
</script>
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
                    ?>

                    <div class="file-preview s6 m4 l3">
                        <input style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div data-ng-click="deletePreview(p)" class="file">

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
                        <!--
                            <span class="size" ><?php echo  bytesToSize($version->getSize())?></span>
                        -->
                        </div>

                    </div>

                    <?php
                    break;
                case 2://Video

                    ?>
                    <div class="file-preview s6 m4 l3">
                        <input style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div data-ng-click="deletePreview(p)" class="file">

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
            }


        }
    }
}
?>