
<div class="form-block <?php echo implode(" ",$class);?>">
    <label><?php echo $label?></label>
    <input type="email" title="<?php echo $label?>" placeholder="<?php echo $placeholder?>" data-ng-model="post.<?php echo $model?>" maxlength="<?php echo $max?>" minlength="<?php echo $min;?>">
</div>