<?php
if(!$type)
{
    $type="text";
}
?>
<script>
    angular.element(function () {


        scope.updateCheckbox<?php echo $model; ?> = function (value) {

            scope.post.<?php echo $model ?>= JSON.stringify(scope.post._<?php echo $model ?>);

            if(scope.validation && scope.validation.<?php echo $model?>)
            {
                scope.validation.<?php echo $model?>.check();
            }
        }
        <?php
        if($regex)
        {
        ?>

        if (!scope.validation) {
            scope.validation = {};
        }


        scope.validation.<?php echo $model?> = {
            isValid: true, check: function () {


                var pattern =/<?php echo $regex?>/g;

                    $.each(scope.post._<?PHP echo $model; ?>,function(k,v){

                        if (v!="false"&&!pattern.test(v)) {
                            scope.validation.<?php echo $model?>.isValid = false;

                            return false;
                        }
                        else {
                            scope.validation.<?php echo $model?>.isValid = true;
                        }

                    });

                setTimeout(function () {
                    scope.$apply();
                });


            }
        };
        $(document).on("input", "[data-ng-model='post.<?php echo $model?>']", function () {

            scope.validation.<?php echo $model?>.check();
        });

        <?php
        }?>

        <?php if($post)
        {
            ?>
        if (!scope.post) {
            scope.post = <?php echo json_encode($post);?>;
        }
        <?php
        }?>


    });


</script>
<div class="form-block <?php echo implode(" ",$class);?>">

    <?php
    $i=1;
    foreach($items as $k=>$v)
    {
        ?>
<label>
    <?php echo $k; ?>
    <input data-ng-click="updateCheckbox<?php echo $model; ?>(post._<?php echo $model?>.option<?php echo $i; ?>)" type="checkbox" title="<?php echo $label?>" data-ng-model="post._<?php echo $model?>.option<?php echo $i; ?>"
           data-ng-true-value="'<?php echo $v; ?>'">
</label>

        <?php
        $i++;
    }
    ?>



</div>

<?php
if($regex) {
    include "error.php";
}
?>
