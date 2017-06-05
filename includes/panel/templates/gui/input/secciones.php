
<script>
    angular.element(function () {

        scope.secciones = <?php echo json_encode($seccionesTree); ?>;
   scope.secciones = <?php  echo  json_encode($subsecciones);?>;
        scope.secciones_group=[];


        $(document).on("change",".select-secciones",function () {

            var seccionId = $(this).val();

            var idx= $(this).data("id");

  
            if($.isNumeric(idx))
            {

                scope.secciones_group=scope.secciones_group.slice(0,(idx+1));

            }
            else
            {
                scope.secciones_group=[];
            }

            scope.$apply();

            if($.isNumeric(seccionId))
            {
                $.ajax(
                    {
                        url:"<?php echo $configuracion->getSiteAddress()."/admin/configuracion/secciones/data.php?act=list&id="?>"+seccionId,
                        method:"get",
                        dataType:"json",
                        success:function (e) {

                            if(e.length>0)
                            {
                                    //Si la seccion ya existe,no la muestro
                                    scope.secciones_group.push(e);

                                setTimeout(function () {
                                    scope.$apply();
                                });

                            }


                        },
                        error:error
                    }
                );
            }

            scope.post.seccion=seccionId;

        });
    });
</script>

<div title="Secciones"  class="form-block secciones <?php echo implode(" ",$class);?>">
    <label>Sección</label>
    <select   class="select-secciones">
        <option value="">-</option>
        <option  data-ng-repeat="s in secciones" value="{{s.id}}">{{s.nombre}}</option>
    </select>

    <div data-ng-repeat="(k,subsecciones) in secciones_group">
        <label>Subsección {{k+1}}</label>
        <select data-id="{{k}}"  class="select-secciones">
            <option value="">-</option>
            <option  data-ng-repeat="sub in subsecciones" value="{{sub.id}}">{{sub.nombre}}</option>
        </select>
    </div>


</div>