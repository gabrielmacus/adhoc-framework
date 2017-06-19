
<script>
    angular.element(function () {

        scope.<?php echo $model?>=<?php echo json_encode($options);?>;

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

    $(document).on("change","[data-ng-model='post.<?php echo $model?>']",function () {

        scope.validation.<?php echo $model?>.check();
    });

</script>


<div title="<?php echo $label?>"  class="form-block <?php echo implode(" ",$class);?>">
    <label><?php echo $label?></label>
    <select  data-ng-options="item for item in <?php echo $model?>"
             data-ng-model="post.<?php echo $model;?>"
    >
    </select>
</div>
<?php
if($regex) {
    include "error.php";
}
?>

