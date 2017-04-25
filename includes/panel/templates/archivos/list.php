<div class="body">
    <script>


        angular.element(function () {


            scope.archivo={};

            scope.$apply();


            scope.save=function () {

                $.ajax
                (
                    {
                        method:"post",
                        url:"<?php echo $configuracion->getSiteAddress()."/admin/posts/archivos"?>",
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

                console.log(scope.post);
            }

        });

    </script>
    <form data-ng-submit="save()">

<?php

include DIR_PATH."/includes/panel/templates/posts/save.php";

$label="Archivos";
$id="archivos1";
include DIR_PATH."/includes/panel/templates/posts/input/files.php";

$label="Archivos 2";
$id="archivos2";
include DIR_PATH."/includes/panel/templates/posts/input/files.php";

?>

    </form>

</div>