<script>
    angular.element(function () {

        scope.<?php echo $model?>=<?php echo $options;?>;
    });
</script>
<div title="<?php echo $label?>"  class="form-block <?php echo implode(" ",$class);?>">
    <label><?php echo $label?></label>
    <select  data-ng-options="item for item in <?php echo $model?>"
             data-ng-model="post.<?php echo $model;?>"
    >
    </select>
</div>
