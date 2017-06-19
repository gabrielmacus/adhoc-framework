<?php
if(!$errorWarningMsg)
{
    $errorWarningMsg="Hay errores en el formulario";
}
?>
<script>


    angular.element(function () {



        if(!scope.post)
        {
            scope.post={};
        }

        <?php
        if($_GET["id"])
        {
        ?>
        scope.post.id=<?php  echo $_GET["id"];?>;
        <?php
        }
        ?>


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
        console.log(scope.post.archivos);

        $.each( scope.post.archivos ,function (tipo,grupos) {

            $.each(grupos,function (k,versiones) {

                console.log(versiones);

                archivos.push({archivo_objeto_id:versiones["<?php echo $fileVersion?>"].nexoId,archivo_id:versiones["<?php echo $fileVersion?>"].id,url:versiones["<?php echo $fileVersion?>"].realName,name:versiones["<?php echo $fileVersion?>"].name,archivo_grupo:versiones["<?php echo $fileVersion?>"].grupo});

            });


        });

        scope.post.archivos = archivos;
        scope.$apply();

        /**  **/




        <?Php
        }?>
        scope.$apply();


        scope.save=function () {

            var areErrors=false;

            $.each(scope.validation,
                function (k,v) {
                    console.log(v);
                    v.check();
                    if(!v.isValid)
                    {
                        toastr.warning('', '<?php echo $errorWarningMsg;?>');
                        return false;
                        areErrors=true;
                    }

                });

            if(areErrors)
            {
                return false;
            }

            return false;
            /** preparo anexos **/

            scope.post.anexos=[];
            $.each(
                scope.post.anexosGroups,function (k,group) {


                    $.each(group,function (clave,valor) {

                        scope.post.anexos.push(valor);

                    });

                }
            );
            /** **/


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
                        toastr.success('', '<?php echo $successMessage;?>');
                        <?php
                        }?>



                    },
                    error:error
                }
            );

        }

    });

</script>

