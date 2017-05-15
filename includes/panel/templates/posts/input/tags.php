
<div class="form-block">


    <script>

        angular.element(function () {
          var <?php echo $model?>=  new Taggle('<?php echo $id?>', {
                tags: ['Try', 'entering', 'one', 'of', 'these', 'tags'],
                duplicateTagClass: 'bounce'
            });

        });
    </script>
    <label><?php echo $label;?></label>
    <div class="tags" id="<?php echo $id?>"></div>
</div>
