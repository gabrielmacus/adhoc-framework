
<div class="form-block">


    <script>


        angular.element(function () {
            var tags=[];


            if(scope.post && scope.post.<?php echo $model?>)
            {
                tags = JSON.parse(angular.copy(scope.post.<?php echo $model?>));

            }
          var <?php echo $model?>=  new Taggle('<?php echo $id?>', {

                tags:tags,
                duplicateTagClass: 'bounce',
                placeholder:"<?php echo $placeholder?>"
            });

        });
    </script>
    <label><?php echo $label;?></label>
    <div style= "border: 1px #9ba096 solid;" class="tags" id="<?php echo $id?>"></div>
</div>
