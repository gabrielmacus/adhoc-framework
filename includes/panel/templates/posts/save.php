<script>


    angular.element(function () {


        scope.post={};


        <?php if($post)

        {
        ?>
        scope.post = <?php echo json_encode($post);?>;
        console.log(scope.post);
        <?Php
        }?>
        scope.$apply();


        scope.save=function () {

            $.ajax
            (
                {
                    method:"post",
                    url:"<?php echo $configuracion->getSiteAddress()."/admin/posts/data.php?t={$t}&act=save"?>",
                    data:angular.copy(scope.post),
                    dataType:"json",
                    success:function (e) {
                        console.log(e);
                    },
                    error:function (e) {

                        console.log(e);
                    }
                }
            )

            console.log(scope.post);
        }

    });

</script>