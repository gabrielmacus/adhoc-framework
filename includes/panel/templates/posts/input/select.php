<div title="<?php echo $label?>"  class="form-block <?php echo implode(" ",$class);?>">
    <label><?php echo $label?></label>
    <select data-ng-model="post.<?php echo $model;?>">
        <option selected disabled>Seleccione una opcion</option>
        <?php  foreach ($options as $k=>$v)
        {
            ?>
            <option value="<?php echo $k;?>"><?php echo $v?></option>
            <?php
        }?>
    </select>
</div>
<script>
   $(document).ready(
       function () {

           var select=new Select({
               el:  document.querySelector('#test'),
               className: 'select-theme-default'
           });

       }
   );
</script>
<div id="test">
    <a>Data</a>
</div>