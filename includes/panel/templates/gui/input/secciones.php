
<script>
    angular.element(function () {


        scope.secciones = <?php  echo  json_decode($subsecciones);?>;

    });
</script>
<div title="Secciones"  class="form-block <?php echo implode(" ",$class);?>">
    <label>Sección</label>
    <select  data-ng-options="item for item in secciones">
        <option value="{{item.id}}">{{item.nombre}}</option>
    </select>
</div>
