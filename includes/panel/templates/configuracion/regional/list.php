<script>


    angular.element(function () {

        <?php if($repositorios)
        {
        ?>

        scope.repositorios = <?php echo json_encode($repositorios)?>;
        <?php
        }else
        {
        ?>
        scope.post = <?php echo json_encode(reset($repositorio))?>;
        console.log( scope.tags1);
        $("#tags1").val();
        $("#add-repositorio").hide();
        $("#new-repositorio").show();
        <?php

        }?>

        scope.delete=function (id) {

            vex.dialog.confirm({
                message: '¿Esta seguro que desea eliminar el repositorio?',
                callback: function (value) {
                    if(value)
                    {
                        $.ajax
                        (
                            {
                                method:"get",
                                url:"<?php echo $configuracion->getSiteAddress()."/admin/repositorios/data.php?act=delete&id="?>"+id,
                                data:angular.copy(scope.post),
                                dataType:"json",
                                success:function (e) {

                                    if(e)
                                    {
                                        location.reload();
                                    }
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
        scope.$apply();

        scope.save=function () {
            console.log(scope.post);
            $.ajax
            (
                {
                    method:"post",
                    url:"<?php echo $configuracion->getSiteAddress()."/admin/repositorios/data.php?act=save"?>",
                    data:angular.copy(scope.post),
                    dataType:"json",
                    success:function (e) {
                        console.log(e);
                    },
                    error:function (e) {

                        console.log(e);
                    }
                }
            );

        }

    });

    $(document).on("click",".item",function () {
        $(this).find(".content").stop();
        $(this).find(".content").slideToggle();
    })
    $(document).on("click","#add-repositorio",function () {

        $("#new-repositorio").slideToggle();

    });
</script>
<header>
    <h2 class="title">Configuración regional</h2>
</header>

<div class="body">

    <?php include "objetos/idioma.php"?>

</div>
