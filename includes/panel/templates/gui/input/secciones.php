
<script>
    angular.element(function () {

        scope.secciones = <?php  echo  json_encode($subsecciones);?>;
        scope.secciones_group=[];


        $(document).on("change",".select-secciones",function () {

            var idx =$(this).data("idx");
            alert(idx);
            var seccionId = $(this).val();

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

                                var isSeccionRendered=false;

                                    $.each(e,function(clave,valor)
                                    {


                                        $.each( scope.secciones_group,function(k,v){

                                            isSeccionRendered= v.filter(
                                            function(el)
                                            {
                                                if(el.id==valor.id)

                                                return el;

                                                    }
                                                );
                                            });
                                    });

                                if(!isSeccionRendered || isSeccionRendered.length==0)
                                {
                                    //Si la seccion ya existe,no la muestro
                                    scope.secciones_group.push(e);
                                    scope.$apply();
                                }



                            }


                        },
                        error:error
                    }
                );
            }

            scope.post.seccion=seccionId;

        });*/
    });
</script>
<div title="Secciones"  class="form-block secciones <?php echo implode(" ",$class);?>">
    <label>Sección</label>
    <select  class="select-secciones">
        <option value="">-</option>
        <option  data-ng-repeat="s in secciones" value="{{s.id}}">{{s.nombre}}</option>
    </select>

    <div data-ng-repeat="(k,subsecciones) in secciones_group">
        <label>Subsección {{k+1}}</label>
        <select data-idx="{{k}}" class="select-secciones">
            <option value="">-</option>
            <option  data-ng-repeat="sub in subsecciones" value="{{sub.id}}">{{sub.nombre}}</option>
        </select>
    </div>


</div>
