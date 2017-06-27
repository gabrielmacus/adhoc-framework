<?php
if(!$type)
{
    $type="text";
}

include "controllers/text.php";
?>

<div class="form-block <?php echo implode(" ",$class);?>">
    <label><?php echo $label?></label>
    <input type="<?php echo $type;?>" title="<?php echo $label?>" placeholder="<?php echo $placeholder?>" data-ng-model="post.<?php echo $model?>">
</div>

<?php
if(isset($regex)) {
    include "error.php";
}
?>
