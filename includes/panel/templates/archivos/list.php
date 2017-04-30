
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
            scope.seleccionar=function () {

                var selected=[];
                $(".file-preview [type='checkbox']:selected").each(function () {
                     var id=$(this).data("id");
                     var name=$(this).data("name");
                     selected.push("name":name,"archivo_id":id);
                });

                parent.postMessage(selected,location.href);
            }

            scope.save=function () {
                console.log(scope.previews);
                $.ajax
                (
                    {
                        method:"post",
                        url:"<?php echo $configuracion->getSiteAddress()."/admin/archivos/data.php?act=save&rep={$_GET["rep"]}"?>",
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

            <div  class="file-preview s6 m4 l3" data-ng-repeat="p in previews" data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'">
                <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
                <div  data-ng-click="deletePreview(p)" class="file" >

                    <figure>
                        <img data-ng-src="{{p.url}}">
                    </figure>

                    <input class="name" data-ng-model="p.name">
                    <span class="size"  data-ng-bind="getMb(p.size)"></span>
                </div>

            </div>

            <div  class="file-preview s6 m4 l3" data-ng-repeat="p in previews" data-ng-if="p.type==''">
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

    <div class="files" >

        <?php

        include DIR_PATH."/includes/panel/templates/archivos/views/1.php";
        ?>
        <div  class="fila center" >
            <button id="seleccionar" style="font-size: 25px;margin-top: 10px;margin-bottom: 10px">Seleccionar</button>
        </div>

        <?php

        include DIR_PATH."/includes/panel/templates/posts/paginador.php";
        ?>

    </div>

</div>