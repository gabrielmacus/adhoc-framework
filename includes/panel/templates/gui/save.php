
<script>


    angular.element(function () {


        if(!scope.post)
        {
            scope.post={};
        }
   



        <?php if($post)

        {
        ?>
        if(!scope.post)
        {

            scope.post = <?php echo json_encode($post);?>;
        }


        /***  cargo adjuntos **/

        var archivos=[];
        if(!scope.post.archivos) {
            scope.post.archivos = <?php echo json_encode($post->getArchivos())?>;
        }

        $.each( scope.post.archivos ,function (tipo,versiones) {


            archivos.push({archivo_id:versiones["<?php echo $fileVersion?>"].id,url:versiones["<?php echo $fileVersion?>"].realName,name:versiones["<?php echo $fileVersion?>"].name,archivo_grupo:versiones["<?php echo $fileVersion?>"].grupo});

        });

        scope.post.archivos = archivos;
        scope.$apply();

        /**  **/


        <?Php
        }?>
        scope.$apply();


        scope.save=function () {
            if(scope.previews)//Para subida de archivos directa
            {
                scope.post.previews=scope.previews;
            }
            if(!scope.post.seccion)
            {
                var url="<?php echo $configuracion->getSiteAddress()."/admin/posts/data.php?t={$t}&act=save"?>";
            }
            else
            {
                var url="<?php echo $configuracion->getSiteAddress()?>/admin/posts/data.php?t="+scope.post.seccion+"&act=save";

            }


            $.ajax
            (
                {
                    method:"post",
                    url:url,
                    data:angular.copy(scope.post),
                    dataType:"json",
                    success:function (e) {



                        <?php if($successMessage)
                        {
                            ?>
                        /*
                        vex.dialog.alert({message:"<?php
                            echo $successMessage;?>",callback:function () {
                            location.reload();
                        }})*/

                    
                        toastr.success('', '<?php echo $successMessage;?>');
                        <?php
                        }?>



                    },
                    error:function (e) {

                        toastr.error('', 'Hubo un error al procesar lo solicitado. Inténtelo mas tarde');

                    }
                }
            );

            console.log(scope.post);
        }

    });

</script>