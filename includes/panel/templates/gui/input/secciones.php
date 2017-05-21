
<script>
    angular.element(function () {


        scope.secciones = <?php  echo  json_encode($subsecciones);?>;

        $(document).on("change",".select-secciones",function () {

            var seccionId = $(this).val();
            alert(seccionId);

            $.ajax(
                {
                    url:"<?php echo $configuracion->getSiteAddress()."/admin/configuracion/secciones/data.php?act=list&id="?>"+seccionId,
                    method:"get",
                    dataType:"json",
                    success:function (e) {

                        console.log(e);

                    },
                    error:error
                }
            );

        });
    });
</script>
<div title="Secciones"  class="form-block <?php echo implode(" ",$class);?>">
    <label>Sección</label>
    <select  class="select-secciones">
        <option value="">-</option>
        <option  data-ng-repeat="s in secciones" value="{{s.id}}">{{s.nombre}}</option>
    </select>



</div>
