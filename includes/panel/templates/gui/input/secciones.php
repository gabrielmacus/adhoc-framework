
<script>
    angular.element(function () {


        scope.secciones = <?php  echo  json_encode($subsecciones);?>;
        scope.secciones_group=[];
        $(document).on("change",".select-secciones",function () {

            var seccionId = $(this).val();
            alert(seccionId);

            $.ajax(
                {
                    url:"<?php echo $configuracion->getSiteAddress()."/admin/configuracion/secciones/data.php?act=list&id="?>"+seccionId,
                    method:"get",
                    dataType:"json",
                    success:function (e) {

                        scope.secciones_group.push(e);

                        scope.$apply();


                    },
                    error:error
                }
            );

        });
    });
</script>
<div title="Secciones"  class="form-block secciones <?php echo implode(" ",$class);?>">
    <label>Sección</label>
    <select  class="select-secciones">
        <option value="">-</option>
        <option  data-ng-repeat="s in secciones" value="{{s.id}}">{{s.nombre}}</option>
    </select>

    <div data-ng-repeat="(k,subsecciones) in secciones_group">
        <label>Subsección {{k}}</label>
        <select  class="select-secciones">
            <option value="">-</option>
            <option  data-ng-repeat="sub in subsecciones" value="{{sub.id}}">{{sub.nombre}}</option>
        </select>
    </div>


</div>
