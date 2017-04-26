<div class="form-block">
    <div class="tags" id="<?php echo $id?>"></div>

    <script>

        angular.element(function () {


    var <?php echo $id?>= new Taggle('<?php echo $id?>', {
                duplicateTagClass: 'bounce',
            onTagAdd: function(event, tag) {

                scope.post.<?php echo $model?>= <?php echo $id?>.getTags().values;
                scope.$apply();
            }
            });
        });
    </script>
</div>