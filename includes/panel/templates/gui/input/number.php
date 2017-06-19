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


                var pattern=/<?php echo $regex?>/g;


                if(!pattern.test(scope.post.<?php echo $model?>) || !scope.post.<?php echo $model?>)
                {
                    scope.validation.<?php echo $model?>.isValid=false;
                }
                else
                {
                    scope.validation.<?php echo $model?>.isValid=true;
                }

                setTimeout(function () {
                    scope.$apply();
                });


            }
        };

        <?php
        }?>

    });

    $(document).on("input","[data-ng-model='post.<?php echo $model?>']",function () {

        scope.validation.<?php echo $model?>.check();
    });

</script>
<div class="form-block <?php echo implode(" ",$class);?>">
    <label><?php echo $label?></label>
    <input string-to-number type="number" title="<?php echo $label?>" placeholder="<?php echo $placeholder?>" data-ng-model="post.<?php echo $model?>"  >
</div>

<?php
if($regex) {
    include "error.php";
}
?>




