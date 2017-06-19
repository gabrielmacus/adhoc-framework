<script>
    angular.element(function () {



        <?php
        if($regex)
        {
        ?>

        if (!scope.validation) {
            scope.validation = {};
        }


        scope.validation.<?php echo $model?>= {
            isValid: true, check: function () {


                $(".secciones select").each(
                    function () {

                        if ($(this).val() == "") {
                            scope.validation.secciones.isValid = false;
                            return false;
                        }
                        else {
                            scope.validation.secciones.isValid = true;
                        }

                    }
                );

                setTimeout(function () {
                    scope.$apply();
                });


            }
        };

        <?php
        }?>

    });

</script>
<div class="form-block <?php echo implode(" ",$class);?>">
    <label><?php echo $label?></label>
    <input type="text" title="<?php echo $label?>" placeholder="<?php echo $placeholder?>" data-ng-model="post.<?php echo $model?>" maxlength="<?php echo $max?>" minlength="<?php echo $min;?>">
</div>

<?php
include "error.php";

?>
