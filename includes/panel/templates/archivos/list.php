
<header>
    <h2 class="title">Archivos en el repositorio</h2>
</header>
<div class="body">


    <script>


        angular.element(function () {


            scope.$apply();


            scope.deletePreview=function (e) {
                var idx = scope.previews.indexOf(e);

                scope.previews.splice(idx,1);

            }

            scope.save=function () {
                console.log(scope.previews);
                $.ajax
                (
                    {
                        method:"post",
                        url:"<?php echo $configuracion->getSiteAddress()."/admin/archivos/data.php?act=save&rep={$_GET["id"]}"?>",
                        data:{previews:angular.copy(scope.previews)},
                        dataType:"json",
                        success:function (e) {
                            console.log(e);
                        },
                        error:function (e) {

                            console.log(e);
                        }
                    }
                );

                console.log(scope.post);
            }

        });

    </script>
    <form data-ng-submit="save()">

        <div class="files">

            <div  class="file-preview s12 m6 l4" data-ng-repeat="p in previews" data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'">
                <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                <div  data-ng-click="deletePreview(p)" class="file" >

                    <figure>
                        <img data-ng-src="{{p.url}}">
                    </figure>

                    <input class="name" data-ng-model="p.name">
                    <span class="size"  data-ng-bind="getMb(p.size)"></span>
                </div>

            </div>

            <div  class="file-preview s12 m6 l4" data-ng-repeat="p in previews" data-ng-if="p.type==''">
                <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                <div  data-ng-click="deletePreview(p)" class="file" >

                    <figure>
                        <img data-ng-src="{{p.url}}">
                    </figure>

                    <input class="name" data-ng-model="p.name">
                    <span class="size"  data-ng-bind="getMb(p.size)"></span>
                </div>

            </div>

</div>
            <?php

$label="Archivos";
$id="archivos1";
            $progressBar=".load-mask";
include DIR_PATH."/includes/panel/templates/archivos/input/files.php";


?>

        <div class="form-block">
            <button  type="submit" class="animated fila relative" >
                <i style="font-size: 30px" class="fa fa-upload" aria-hidden="true"></i>
                <span class="load-mask animated"></span>
            </button>

        </div>



    </form>

    <div class="files">


        <?php

        foreach ($archivos as $archivo)
        {

            foreach ($archivo as $grupo)
            {



                foreach ($grupo as $versiones) {

                    $version= reset($versiones);
                    var_dump($version);
                    $ext =$version->getExtension();


                    ?>


                    <div class="file-preview s12 m6 l4">
                        <input style="position: absolute;top: 20px;left: 20px;-webkit-transform: scale(1.7);-moz-transform: scale(1.7);-ms-transform: scale(1.7);-o-transform: scale(1.7);transform: scale(1.7);" type="checkbox">
                        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                        <div data-ng-click="deletePreview(p)" class="file">

                            <figure>
                                <?php

                                switch ($ext)
                                {
                                    default:

                                        break;

                                    case "svg":
                                    case "jpeg":
                                    case "bmp":
                                    case "png":
                                    case "gif":
                                    case "jpg":

                                        $version= $versiones[$versionPanel];

                                        ?>
                                        <img data-ng-src="<?php echo $version->getRealName()?>">
                                        <?php
                                        break;
                                }
                                ?>
                            </figure>

                            <span class="name"><?php echo $version->getName()?></span>
                            <span class="size" ><?php echo  bytesToSize($version->getSize())?></span>
                        </div>

                    </div>


                    <?Php
                }
            }
        }
        ?>

    </div>

</div>