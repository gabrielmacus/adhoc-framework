<script>


    angular.element(function () {


        scope.post={archivos:[]};



        <?php if($post)

        {
        ?>
        scope.post = <?php echo json_encode($post);?>;

        <?Php
        }?>
        scope.$apply();


        scope.save=function () {
            if(scope.previews)//Para subida de archivos directa
            {
                scope.post.previews=scope.previews;
            }
            console.log(scope.post);
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
                        vex.dialog.alert({message:"<?php
                            echo $successMessage;?>",callback:function () {
                            location.reload();
                        }})
                        <?php
                        }?>



                    },
                    error:function (e) {

                        console.log(e);
                        vex.dialog.alert("Hubo un error al procesar lo solicitado. Inténtelo mas tarde");
                    }
                }
            );

            console.log(scope.post);
        }

    });

</script>