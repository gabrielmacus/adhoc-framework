
<?php



var_dump($subsecciones);

?>
<script>
    angular.element(function () {




    });
</script>
<div title="Secciones"  class="form-block <?php echo implode(" ",$class);?>">
    <label>Sección</label>
    <select  data-ng-options="item for item in <?php echo $model?>"
             data-ng-model="post.<?php echo $model;?>">
    </select>
</div>
