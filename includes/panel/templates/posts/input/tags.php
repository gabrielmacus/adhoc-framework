<div class="form-block">

    <label><?php echo $label;?></label>
    <div class="tags" id="<?php echo $id?>"></div>

    <script>

        angular.element(function () {


     scope.<?php echo $id?>= new Taggle('<?php echo $id?>', {
                duplicateTagClass: 'bounce',
                placeholder:"<?php echo $placeholder?>",
            onTagAdd: function(event, tag) {

                scope.post.<?php echo $model?>= <?php echo $id?>.getTags().values;
                scope.$apply();
            }
            });
        });
    </script>
</div>