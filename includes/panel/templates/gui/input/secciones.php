
<script>
    angular.element(function () {
        var secciones = <?php echo  json_encode(  $GLOBALS["seccionDAO"]->selectSecciones());?>;
        
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


            if($.isNumeric(seccionId))
            {

                var result= secciones.filter(function (el) {

                    return el.tipo == seccionId;

                });


                if(result.length>0)
                {

                    scope.secciones_group.push(result);
                }

            }

            scope.post.seccion=seccionId;

            scope.$apply();

            scope.validation.secciones.check();
        });

        if(!scope.validation)
        {
            scope.validation={};
        }



        scope.validation.secciones={isValid:true, check:function() {


            $(".secciones select").each(
                function () {

                    if($(this).val()=="")
                    {
                        scope.validation.secciones.isValid=false;
                        return false;
                    }
                    else
                    {
                        scope.validation.secciones.isValid=true;
                    }

                }
            );

            setTimeout(function () {
                scope.$apply();
            });


    }
    };



        scope.seccionesLoaded=function () {

            <?php

            if($post)
            {


            ?>
            var breadcrumb=<?Php echo json_encode($GLOBALS["seccionDAO"]->selectSeccionBreadcrumb($post->getSeccion()))?>;


            $.each(breadcrumb,function (k,v) {

                if(v.tipo!=0)
                {
                    console.log(v);
                    var select=$(".select-secciones").last();
                    select.val(parseInt(v.id));
                    select.trigger("change");
                }

            });
            <?php
            }?>
        }


    });
</script>

<?php
if(!$errorMsg)
{
    $errorMsg="Seleccione una sección";
}
?>

<div title="Secciones"  class="form-block secciones <?php echo implode(" ",$class);?>">
    <label>Sección</label>
    <select   class="select-secciones">
        <option value="">-</option>
        <option on-finish-render="seccionesLoaded()" data-ng-repeat="s in secciones" value="{{s.id}}">{{s.nombre}}</option>
    </select>

    <div data-ng-repeat="(k,subsecciones) in secciones_group" >
        <label>Subsección {{k+1}}</label>
        <select data-id="{{k}}"  class="select-secciones">
            <option value="">-</option>
            <option  data-ng-repeat="sub in subsecciones" value="{{sub.id}}">{{sub.nombre}}</option>
        </select>
    </div>

</div>


<?php
$model="secciones";
include "error.php";

?>
