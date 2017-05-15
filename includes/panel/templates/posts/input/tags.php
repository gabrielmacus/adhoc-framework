
<div class="form-block">


    <script>


        angular.element(function () {
            var tags=[];


            console.log(JSON.parse(<?php echo json_encode($post)?>[<?php echo $model?>]));
            /*if(scope.post && scope.post.<?php echo $model?>)
            {
                tags = JSON.parse(angular.copy(scope.post.<?php echo $model?>));


            }*/
          var <?php echo $model?>=  new Taggle('<?php echo $id?>', {

                tags:tags,
                duplicateTagClass: 'bounce',
                placeholder:"<?php echo $placeholder?>",
                onTagAdd:function () {

                    scope.post.<?php echo $model?>  = JSON.stringify(<?php echo $model?>.getTags().values);
                },
                onTagRemove:function () {

                    scope.post.<?php echo $model?>  = JSON.stringify(<?php echo $model?>.getTags().values);
                }
            });

        });
    </script>
    <label><?php echo $label;?></label>
    <div style= "border: 1px #9ba096 solid;" class="tags" id="<?php echo $id?>"></div>
</div>
