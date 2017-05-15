
<div class="form-block">


    <script>
        var tags=[];

        <?php if($post){?>
        tags= JSON.parse(angular.copy(scope.post.<?php echo $model?>));
        <?php}?>

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
