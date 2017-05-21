
<script>
    angular.element(function () {


        scope.secciones = <?php  echo  json_encode($subsecciones);?>;

    });
</script>
<div title="Secciones"  class="form-block <?php echo implode(" ",$class);?>">
    <label>Sección</label>
    <select  data-ng-options="item for item in secciones">
    </select>
</div>
