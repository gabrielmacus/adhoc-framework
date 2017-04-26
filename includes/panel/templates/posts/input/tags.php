<div class="form-block">
    <div class="tags" id="<?php echo $id?>"></div>

    <script>

        angular.element(function () {


    var <?php echo $id?>= new Taggle('<?php echo $id?>', {
                duplicateTagClass: 'bounce',
            onTagAdd: function(event, tag) {

                scope.<?php echo $model?>= this.getTags();
                scope.$apply();
            }
            });
        });
    </script>
</div>