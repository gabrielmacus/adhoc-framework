
<div class="form-block">


    <script>

        angular.element(function () {
            new Taggle('<?php echo $id?>', {
                tags: ['Try', 'entering', 'one', 'of', 'these', 'tags'],
                duplicateTagClass: 'bounce'
            });

        });
    </script>
    <label><?php echo $label;?></label>
    <div class="tags" id="<?php echo $id?>"></div>
</div>
<!--
<script>

    angular.element(function () {

       scope.tagsModified<?php echo $model?>=function () {


           scope.post.<?php echo $model?> = JSON.stringify(copy(scope.post.<?php  echo $model?>));
        }
    });
    </script>

<div class="form-block">-->
<!--
    <label><?php echo $label;?></label>
    <div class="tags" id="<?php echo $id?>"></div>

    <script>

        angular.element(function () {


     <?php echo $id?>= new Taggle('<?php echo $id?>', {
                duplicateTagClass: 'bounce',
                placeholder:"<?php echo $placeholder?>",
            onTagAdd: function(event, tag) {

                scope.post.<?php echo $model?>= <?php echo $id?>.getTags().values;
                scope.$apply();
            }
            });
        });
    </script>
    -->
  <!--  <label><?php echo $label;?></label>
    <tags-input  data-on-tag-added="tagsModified<?php echo $model?>()" data-on-tag-removed="tagsModified<?php echo $model?>()" data-min-tags="<?php echo $min?>"  data-max-tags="<?php echo $max?>" data-placeholder="<?php echo $placeholder?>" data-ng-model="post.<?php echo $model?>"></tags-input>

</div>-->