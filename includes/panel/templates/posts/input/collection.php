<script>

    angular.element(function () {

        <?php if($post)
        {
            ?>
        if(!scope.post)
        {
            scope.post= <?php echo json_encode($post);?>;
        }

        if(scope.post.<?php echo $model?>)
        {
            scope.post.<?php echo $model?>  = JSON.parse(angular.copy(scope.post.<?php echo $model?>));

        }


        <?php
        }?>


    });
</script>
<div class="form-block <?php echo implode(" ",$class);?>">
    <label><?php echo $label?></label>
   <ul class="collection">
      <li class="item" data-ng-repeat="i in post.<?php echo $model?>">A</li>
   </ul>
    <h3 data-ng-hide="post.<?php echo $model?>.length>0"><?php echo $emptyMsg;?></h3>
</div>