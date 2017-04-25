<div title="<?php echo $label?>"  class="form-block <?php echo implode(" ",$class);?>">
    <label><?php echo $label?></label>
    <select name="post.<?php echo $model;?>">
        <?php  foreach ($options as $k=>$v)
        {
            ?>
            <option value="<?php echo $k;?>"><?php echo $v?></option>
            <?php
        }?>
    </select>
</div>