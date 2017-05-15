
<div class="form-block">


    <script>
        var tags=[];


        if(scope.post.<?php echo $model?>)
        {
            tags = JSON.parse(angular.copy(scope.post.<?php echo $model?>));

        }

        angular.element(function () {
          var <?php echo $model?>=  new Taggle('<?php echo $id?>', {

                tags:tags,
                duplicateTagClass: 'bounce'
            });

        });
    </script>
    <label><?php echo $label;?></label>
    <div class="tags" id="<?php echo $id?>"></div>
</div>
