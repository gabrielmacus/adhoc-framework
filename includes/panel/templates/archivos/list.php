<script async>
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
</script>
<header>
    <h2 class="title">Archivos en el repositorio</h2>
</header>
<div class="body">

    <a data-ng-click="deleteSelectedFiles()" style="position: fixed;bottom: 0px;right: 0px;font-size: 50px;padding:10px;background-color: #2e3032;color: white;z-index: 10">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>

    <script>


        angular.element(function () {


            scope.$apply();


            scope.checkMime=function (mime) {

                if(mime)
                {
                    mime = mime.split("/");
                    mime = mime[0];

                }

                return mime;

            }
            scope.deletePreview=function (e) {
                var idx = scope.previews.indexOf(e);

                scope.previews.splice(idx,1);

            }
            function getSelected() {
                var selected=[];
                $(".file-preview [type='checkbox']:checked").each(function () {
                    var id=$(this).data("id");
                    var name=$(this).data("name");
                    var url =$(this).data("url");
                  
                    var data={"name":name,"archivo_id":id,"archivo_grupo":"<?Php echo $_GET["grupo"]?>",url:url};
                    <?Php  if($_GET["embeed"])
                    {
                        ?>
                    data.embeed="<?php echo $_GET["embeed"];?>";
                    
                    
                    <?php
                    }?>
                    selected.push(data);
                    
                });
                return selected
            }
            scope.seleccionar=function () {

                parent.postMessage(getSelected(),"<?php echo $configuracion->getSiteAddress()?>");
            }

            scope.deleteSelectedFiles=function () {
                vex.dialog.confirm({
                    message: '¿Eliminar archivos seleccionados?',
                    callback: function (value) {
                        if (value) {

                            $.ajax
                            (
                                {
                                    method:"post",
                                    url:"<?php echo $configuracion->getSiteAddress()."/admin/archivos/data.php?act=delete"?>",
                                    data:{files:getSelected()},
                                    dataType:"json",
                                    success:function (e) {
                                        console.log(e);
                                        location.reload();
                                    },
                                    error:function (e) {

                                        console.log(e);
                                    }
                                }
                            );

                        }
                    }
                })
            }



            scope.save=function () {
                console.log(scope.previews);
                toastr.info('',"Se están actualizando los archivos");
                  $.ajax
                (
                    {
                        method:"post",
                        url:"<?php echo $configuracion->getSiteAddress()."/admin/archivos/data.php?act=save&rep={$_GET["rep"]}"?>",
                        data:{previews:angular.copy(scope.previews)},
                        dataType:"json",
                        success:function (e) {
                            console.log(e);


                            toastr.success('', 'Archivos actualizados correctamente');
                        location.reload();
                        },
                        error:error
                    }
                );

                console.log(scope.post);
            }

        });

    </script>
    <form data-ng-submit="save()">

        <div class="files">

            <div  class="file-preview s12 m6 l3 animated bounceIn" data-ng-repeat="p in previews" data-ng-if="checkMime(p.mime)=='image'">
                <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                <div  class="file "  >

                    <span  data-ng-click="deletePreview(p)" style="position: absolute;left: 10px;top: 10px;color: rgba(220, 69, 47, 1);font-size: 23px;"><i class="fa fa-times" aria-hidden="true"></i></span>
                    <figure>
                        <img data-ng-src="{{p.url}}">
                    </figure>

                    <input class="name" data-ng-model="p.name">
                    <span class="size"  data-ng-bind="getMb(p.size)"></span>
                </div>

            </div>

            <div  class="file-preview s12 m4 l3" data-ng-repeat="p in previews" data-ng-if="checkMime(p.mime)=='application'">
                <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                <div  class="file" >

                    <span  data-ng-click="deletePreview(p)" style="position: absolute;left: 10px;top: 10px;color: rgba(220, 69, 47, 1);font-size: 23px;"><i class="fa fa-times" aria-hidden="true"></i></span>

                    <figure class="center">
                        <i style="font-size: 150px;    top: 15%;
    position: relative;" class="fa fa-file-o" aria-hidden="true"></i>
                    </figure>
                    <input class="name" data-ng-model="p.name">
                    <span class="size"  data-ng-bind="getMb(p.size)"></span>
                </div>

            </div>

            <div  class="file-preview s12 m4 l3" data-ng-repeat="p in previews" data-ng-if="checkMime(p.mime)=='audio'">
                <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                <div  class="file" >

                    <span  data-ng-click="deletePreview(p)" style="position: absolute;left: 10px;top: 10px;color: rgba(220, 69, 47, 1);font-size: 23px;"><i class="fa fa-times" aria-hidden="true"></i></span>

                    <figure style="text-align: center;padding-top: 11%;">
                        <i style="font-size: 150px;    bottom: 10px;
    position: relative;" class="fa fa-music" aria-hidden="true"></i>

                        <audio  style="    bottom: 40px;
    width: 100%;
    position: absolute;
    left: 0;" controls data-ng-src="{{p.url}}">
                    </figure>
                    <input class="name" data-ng-model="p.name">
                    <span class="size"  data-ng-bind="getMb(p.size)"></span>
                </div>

            </div>

            <!-- videos sindicados -->
            <div  class="file-preview s12 m4 l3" data-ng-repeat="p in previews" data-ng-if="p.type=='youtube' || p.type=='vimeo'">
                <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                <div  class="file" >

                    <span  data-ng-click="deletePreview(p)" style="position: absolute;left: 10px;top: 10px;color: rgba(220, 69, 47, 1);font-size: 23px;"><i class="fa fa-times" aria-hidden="true"></i></span>

                    <figure>
                        <img data-ng-src="{{p.size}}">


                        <i data-ng-if="p.type=='youtube'" style="    z-index: 90;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 44px;color: #e52d27" class="fa fa-youtube" aria-hidden="true"></i>
                        <i data-ng-if="p.type=='vimeo'" style="    z-index: 90;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 44px;color: rgba(56, 146, 225, 1)" class="fa fa-vimeo" aria-hidden="true"></i>


                    </figure>
                    <input class="name" data-ng-model="p.name">
                </div>

            </div>
            <!-- video propio -->
            <div  class="file-preview s12 m6 l3 animated bounceIn" data-ng-repeat="p in previews" data-ng-if="checkMime(p.mime)=='video'">
                <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                <div  class="file "  >

                    <span  data-ng-click="deletePreview(p)" style="position: absolute;left: 10px;top: 10px;color: rgba(220, 69, 47, 1);font-size: 23px;"><i class="fa fa-times" aria-hidden="true"></i></span>
                    <figure>
                        <video controls style="width: 100%;height: 100%" data-ng-src="{{p.url}}">
                    </figure>

                    <input class="name" data-ng-model="p.name">
                    <span class="size"  data-ng-bind="getMb(p.size)"></span>
                </div>

            </div>

</div>
            <?php

$id="archivos1";
     
            $progressBar=".load-mask";
include DIR_PATH."/includes/panel/templates/archivos/input/files.php";



?>
<script>

    angular.element(function () {
        scope.previews=[];
        console.log(<?php echo json_encode($archivos)?>);


    });
</script>

        <div data-ng-if="previews.length>0 || uploading" class="form-block">
            <button  type="submit" class="animated fila relative" >
                <i style="font-size: 30px" class="fa fa-upload" aria-hidden="true"></i>
                <span class="load-mask animated"></span>
            </button>

        </div>



    </form>

    <div class="files"  style="position: relative">

        <?php

        include DIR_PATH."/includes/panel/templates/archivos/views/1.php";
        ?>

        <?php if($_GET["modal"])
        {
            ?>
            <div  class="fila center" >
                <button data-ng-click="seleccionar()" style="font-size: 25px;margin-top: 10px;margin-bottom: 10px">Seleccionar</button>
            </div>
            <?php
        }?>


        <?php

        include DIR_PATH."/includes/panel/templates/gui/paginador.php";
        ?>



    </div>

</div>