
<script>
    angular.element(function () {

        scope.secciones=<?php    echo json_encode($secciones)?>;
        scope.seccion={};
scope.$apply();
scope.deleteSeccion=function (s) {

    vex.dialog.open({
        message: '¿Eliminar la seccion #'+s.id+''+s.nombre+'?',
        input: [
            '<input name="name" type="text" required />',
        ].join(''),
        buttons: [
            $.extend({}, vex.dialog.buttons.YES, { text: 'Si' }),
            $.extend({}, vex.dialog.buttons.NO, { text: 'No' })
        ],
        callback: function (data) {
            if (!data) {

            } else {

                scope.seccion.nombre=data.name;
                var url = "<?php echo $configuracion->getSiteAddress()?>/admin/configuracion/secciones/data.php?act=delete";
                if(scope.seccion.id)
                {
                    url+="&id="+scope.seccion.id;
                }
                $.ajax
                (
                    {
                        method:"post",
                        url:url,
                        data:angular.copy(scope.seccion),
                        dataType:"json",
                        success:function (e) {

                            $.ajax
                            (
                                {
                                    method: "get",
                                    url: "<?php echo $configuracion->getSiteAddress()?>/admin/configuracion/secciones/data.php?act=list",
                                    dataType: "json",
                                    success: function (e) {
                                        scope.secciones = e;
                                        scope.$apply();
                                        toastr.success('', 'Seccion guardada con éxito');
                                    }
                                }
                            );


                        },
                        error:error
                    }
                );

            }
        }
    })


}
scope.addSubseccion=function (tipo) {

    scope.seccion.tipo=tipo;

    vex.dialog.open({
        message: 'Nombre de la seccion',
        input: [
            '<input name="name" type="text" required />',
        ].join(''),
        buttons: [
            $.extend({}, vex.dialog.buttons.YES, { text: 'Aceptar' }),
            $.extend({}, vex.dialog.buttons.NO, { text: 'Cancelar' })
        ],
        callback: function (data) {
            if (!data) {

            } else {

                scope.seccion.nombre=data.name;
                var url = "<?php echo $configuracion->getSiteAddress()?>/admin/configuracion/secciones/data.php?act=save";
                if(scope.seccion.id)
                {
                     url+="&id="+scope.seccion.id;
                }
                $.ajax
                (
                    {
                        method:"post",
                        url:url,
                        data:angular.copy(scope.seccion),
                        dataType:"json",
                        success:function (e) {

                                $.ajax
                                (
                                    {
                                        method: "get",
                                        url: "<?php echo $configuracion->getSiteAddress()?>/admin/configuracion/secciones/data.php?act=list",
                                        dataType: "json",
                                        success: function (e) {
                                            scope.secciones = e;
                                            scope.$apply();
                                            toastr.success('', 'Seccion guardada con éxito');
                                        }
                                    }
                                );


                        },
                        error:error
                    }
                );

            }
        }
    })

}



    });
</script>

<header>
    <h2><?php echo $lang["secciones"]?></h2>
</header>
<script type="text/ng-template" id="categoryTree">
    <span>{{ seccion.nombre }}</span>
    <i data-ng-click="addSubseccion(seccion.id)" class="fa fa-plus-square-o icon add-seccion" aria-hidden="true"></i>
    <i data-ng-click="deleteSeccion(seccion)" data-ng-hide="seccion.cantPosts > 0" class="fa fa-trash icon" aria-hidden="true"></i>
    <ul ng-if="seccion.secciones">
        <li ng-repeat="(key,seccion)  in seccion.secciones" ng-include="'categoryTree'">

        </li>
    </ul>
</script>

<div class="body">

    <ul class="secciones">
        <li data-ng-repeat="(key,seccion) in secciones"  ng-include="'categoryTree'"></li>
    </ul>

</div>
