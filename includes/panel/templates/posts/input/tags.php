
<div class="form-block">


    <script>

        angular.element(function () {
          var <?php echo $model?>=  new Taggle('<?php echo $id?>', {
              <?PHP if($post){?>  tags: JSON.parse(angular.copy(scope.post.<?php echo $model?>)),<?php}?>
                duplicateTagClass: 'bounce'
            });

        });
    </script>
    <label><?php echo $label;?></label>
    <div class="tags" id="<?php echo $id?>"></div>
</div>
