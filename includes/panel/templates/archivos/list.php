
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

                console.log(mime);
                mime = mime.split("/");
                mime = mime[0];

                console.log(mime);
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

            <div  class="file-preview s6 m4 l3" data-ng-repeat="p in previews" data-ng-if="checkMime(p.mime)=='application'">
                <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                <div  class="file" >

                    <span  data-ng-click="deletePreview(p)" style="position: absolute;left: 10px;top: 10px;color: rgba(220, 69, 47, 1);font-size: 23px;"><i class="fa fa-times" aria-hidden="true"></i></span>

                    <figure style=" text-align: center;padding-top: 11%;">
                        <i style="font-size: 150px" class="fa fa-file-o" aria-hidden="true"></i>

                    </figure>
                    <input class="name" data-ng-model="p.name">
                    <span class="size"  data-ng-bind="getMb(p.size)"></span>
                </div>

            </div>

</div>
            <?php

$label="Previsualización de subidas";
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