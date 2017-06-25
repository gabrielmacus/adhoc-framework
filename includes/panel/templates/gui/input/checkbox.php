<?php
if(!$type)
{
    $type="text";
}
?>
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
        $(document).on("input","[data-ng-model='post.<?php echo $model?>']",function () {

            scope.validation.<?php echo $model?>.check();
        });

        <?php
        }?>

        <?php if($post)
        {
            ?>
        if(!scope.post)
        {
            scope.post= <?php echo json_encode($post);?>;
        }
        <?php
        }?>

        if(!scope.post)
        {
            scope.post={};
        }

    });


</script>
<div class="form-block <?php echo implode(" ",$class);?>">

    <?php
    foreach($items as $k=>$v)
    {
        ?>
<label>
    <?php echo $k; ?>
    <input type="checkbox" title="<?php echo $label?>" data-ng-model="post.<?php echo $model?>"
           data-ng-true-value="'<?php echo $v; ?>'">
</label>

        <?php
    }
    ?>



</div>

<?php
if($regex) {
    include "error.php";
}
?>
