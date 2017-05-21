
<script>
    angular.element(function () {


        scope.secciones = <?php  echo  json_encode($subsecciones);?>;

    });
</script>
<div title="Secciones"  class="form-block <?php echo implode(" ",$class);?>">
    <label>Sección</label>
    <select  >
        <option  data-ng-repeat="s in secciones" value="{{s.id}}">{{s.nombre}}</option>
    </select>
</div>
