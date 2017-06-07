<div class="form-block <?php echo implode(" ",$class);?>">
    <label><?php echo $label?></label>
    <textarea  title="<?php echo $label?>" placeholder="<?php echo $placeholder?>" data-ng-model="post.<?php echo $model?>" maxlength="<?php echo $max?>" minlength="<?php echo $min;?>">
        
    </textarea>

</div>