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
            $.ajax
            (
                {
                    method:"post",
                    url:"<?php echo $configuracion->getSiteAddress()."/admin/posts/data.php?t={$t}&act=save"?>",
                    data:angular.copy(scope.post),
                    dataType:"json",
                    success:function (e) {

                        vex.dialog.alert({message:"<?php
                            echo $successMessage;?>",callback:function () {
                            location.reload();
                        }})


                    },
                    error:function (e) {

                        vex.dialog.alert("Hubo un error al procesar lo solicitado. Inténtelo mas tarde");
                    }
                }
            );

            console.log(scope.post);
        }

    });

</script>