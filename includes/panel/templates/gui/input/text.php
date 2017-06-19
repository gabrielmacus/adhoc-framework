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


                if(!post.<?php echo $model?>.match(/<?php echo $regex?>/i))
                {
                    scope.validation.<?php echo $model?>.isValid=false;
                }

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
    <input type="text" title="<?php echo $label?>" placeholder="<?php echo $placeholder?>" data-ng-model="post.<?php echo $model?>">
</div>

<?php
if($regex) {
    include "error.php";
}
?>
