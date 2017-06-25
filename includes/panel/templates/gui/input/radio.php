<?php
if(!$type)
{
    $type="text";
}
?>
<script>
    angular.element(function () {


        scope.updateRadio<?php echo $model?> = function () {

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
                    if(!pattern.test(scope.post.<?php echo $model?>))
                    {
                        scope.validation.<?php echo $model?>.isValid=false;
                        setTimeout(function () {
                            scope.$apply();
                        });

                        return false;
                    }
                    else
                    {
                        scope.validation.<?php echo $model?>.isValid=true;
                        setTimeout(function () {
                            scope.$apply();
                        });

                        return true;
                    }



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

        <label  class="s12 m6 l4">
              <span style="    position: relative;
    top: 18px;"><?php echo $k?></span>
            <input data-ng-click="updateRadio<?php echo $model?>()" title="<?php echo $label?>" data-ng-model="post.<?php echo $model?>" type="radio" value="<?php echo $v?>">

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
