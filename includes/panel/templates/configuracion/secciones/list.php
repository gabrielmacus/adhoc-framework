
<script>
    angular.element(function () {

        scope.secciones=<?php    echo json_encode($secciones)?>;

        scope.seccion={};
scope.addSeccion=function () {

    scope.seccion.tipo=0;
    addSeccion();
}
        function addSeccion() {
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

                                    toastr.success('', 'Sección guardada con éxito');
                                    loadSecciones();


                                },
                                error:error
                            }
                        );

                    }
                }
            })
        }
scope.deleteSeccion=function (s) {

    vex.dialog.open({
        message: '¿Eliminar la seccion #'+s.id+' '+s.nombre+'?',
        buttons: [
            $.extend({}, vex.dialog.buttons.YES, { text: 'Ok' }),
            $.extend({}, vex.dialog.buttons.NO, { text: 'Cancelar' })
        ],
        callback: function (data) {
            if (!data) {

            } else {

                scope.seccion.nombre=data.name;
                var url = "<?php echo $configuracion->getSiteAddress()?>/admin/configuracion/secciones/data.php?act=delete&id="+s.id;;

                $.ajax
                (
                    {
                        method:"get",
                        url:url,
                        dataType:"json",
                        success:function (e) {

                            toastr.success('', 'Seccion eliminada');
                            loadSecciones();

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
addSeccion();


}

function loadSecciones() {
    $.ajax
    (
        {
            method: "get",
            url: "<?php echo $configuracion->getSiteAddress()?>/admin/configuracion/secciones/data.php?act=list",
            dataType: "json",
            success: function (e) {
                scope.secciones = e;
                scope.$apply();
                toastr.info('','Secciones actualizadas');
            }
        }
    );
}
        scope.checkPostsInside=function (s) {


            var subsecciones = s.secciones;
            var postsInside=0;

            $.each(subsecciones,function (k,v) {
                if(v.cantPosts)
                {
                    postsInside+=parseInt(v.cantPosts);
                }
            });

            s.cantPosts=postsInside;



            /*
            if(postsInside)
            {
                return true;
            }
            else
            {
                return false;

            }*/

        }
        scope.$apply();
    });
</script>

<header>
    <h2><?php echo $lang["secciones"]?></h2>
</header>
<script type="text/ng-template" id="categoryTree">
    <span>{{ seccion.nombre }}</span>
    <i data-ng-click="addSubseccion(seccion.id)" class="fa fa-plus-square-o icon add-seccion" aria-hidden="true"></i>
    <i data-ng-click="deleteSeccion(seccion)"  data-ng-init="checkPostsInside(seccion)" data-ng-hide="seccion.cantPosts > 0" class="fa fa-trash icon" aria-hidden="true"></i>
    <ul ng-if="seccion.secciones">
        <li data-posts="{{seccion.cantPosts}}" data-ng-repeat="(key,seccion)  in seccion.secciones" ng-include="'categoryTree'">

        </li>
    </ul>

</script>

<div class="body">
    <button data-ng-click="addSeccion()" class="btn" style="margin-bottom: 10px">Nueva sección</button>

    <ul class="secciones">
        <li data-posts="{{seccion.cantPosts}}" data-ng-repeat="(key,seccion) in secciones"  ng-include="'categoryTree'"></li>
    </ul>
    <h3 class="no-content" data-ng-if="secciones.length==0">No hay secciones para mostrar</h3>
</div>
