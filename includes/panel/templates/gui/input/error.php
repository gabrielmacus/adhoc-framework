
<?php

if(!$errorMsg)
{
    $errorMsg="Complete el campo correctamente";
}

?>

<div class="validation-error" data-ng-if="!validation.<?php echo $model;?>.isValid">
    <span class="text"><?php echo $errorMsg;?></span>
</div>
