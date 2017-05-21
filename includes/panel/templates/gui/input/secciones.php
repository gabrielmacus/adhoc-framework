
<script>
    angular.element(function () {


        scope.secciones = <?php  echo  json_encode($subsecciones);?>;

        scope.loadSecciones = function (s) {

            console.log(s);
        }
    });
</script>
<div title="Secciones"  class="form-block <?php echo implode(" ",$class);?>">
    <label>Sección</label>
    <select data-ng-change="loadSecciones(s)">
        <option value="">-</option>
        <option  data-ng-repeat="s in secciones" value="{{s.id}}">{{s.nombre}}</option>
    </select>


</div>
