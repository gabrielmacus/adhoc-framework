
<div class="form-block">


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


                    var arr=JSON.parse(scope.post.<?php echo $model?>);


                    <?php
                    if(is_numeric($max))
                    {
                    ?>

                    if(arr.length><?php echo $max;?>)
                    {

                        scope.validation.<?php echo $model?>.isValid=false;
                        scope.$apply();
                        console.log("Max");
                        return false;
                    }
                    else
                    {

                        scope.validation.<?php echo $model?>.isValid=true;

                    }


                    <?php
                    }?>



                    <?php
                    if(is_numeric($min))
                    {
                    ?>
                    if(arr.length<<?php echo $min;?>)
                    {
                        scope.validation.<?php echo $model?>.isValid = false;
                        scope.$apply();
                        console.log("Min");
                        return false;
                    }
                    else
                    {

                        scope.validation.<?php echo $model?>.isValid=true;

                    }
                    <?php
                    }?>



                    var pattern=/<?php echo $regex?>/g;


                    $.each(arr,function (clave,valor) {
                        
                        if(!pattern.test(valor) || !valor)
                        {
                            scope.validation.<?php echo $model?>.isValid=false;
                            scope.$apply();
                            return false;
                        }
                        else
                        {
                            scope.validation.<?php echo $model?>.isValid=true;
                        }

                    });

                    scope.$apply();




                }
            };
            $(document).on("change","[data-ng-model='post.<?php echo $model?>']",function () {

                scope.validation.<?php echo $model?>.check();
            });

            <?php
            }?>


            var tags=[];

            <?php if($post)
            {
                ?>
            if(!scope.post)
            {
                scope.post  = <?php echo json_encode($post)?>;
            }

            if(typeof  scope.post.<?php echo $model?> ==='string')
            {try
            {             tags = JSON.parse(angular.copy(scope.post.<?php echo $model?>));
            }
            catch (e)
            {

            }


            }
            else
            {
                tags = angular.copy(scope.post.<?php echo $model?>);

            }

            setTimeout(function () {
                scope.$apply();
            })
            <?php
            }?>

if(!tags)
{
    tags=[];
}
          var <?php echo $model?>=  new Taggle('<?php echo $id?>', {

                tags:tags,
                duplicateTagClass: 'bounce',
                placeholder:"<?php echo $placeholder?>",
                onTagAdd:function () {
                    
                    scope.post.<?php echo $model?>  = JSON.stringify(<?php echo $model?>.getTags().values);

                    scope.validation.<?php echo $model?>.check();
             
                },
                onTagRemove:function () {

                    scope.post.<?php echo $model?>  = JSON.stringify(<?php echo $model?>.getTags().values);
                    scope.validation.<?php echo $model?>.check();
                }
            });

        });
    </script>
    <label><?php echo $label;?></label>
    <div style= "border: 1px #9ba096 solid;" class="tags" id="<?php echo $id?>"></div>
</div>
<?php
if($regex) {
    include "error.php";
}
?>

