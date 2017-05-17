<script>
    angular.element(function () {

        scope.idioma={};


        scope.selectPredeterminado=function(i)
        {
            i.predeterminado=1;
            scope.idioma = i;

            saveIdioma();
        }

        function saveIdioma() {

            var url="<?php echo $configuracion->getSiteAddress()?>/admin/configuracion/regional/idioma/data.php?act=save";
            if(scope.idioma.id)
            {
                url+="&id="+scope.idioma.id;
            }

            $.ajax
            (
                {
                    method:"post",
                    url:url,
                    data:angular.copy(scope.idioma),
                    dataType:"json",
                    success:function (e) {

                        scope.idioma.id=e;
                        scope.idiomas.push(angular.copy(scope.idioma));
                        scope.$apply();
                        toastr.success('', 'Idioma agregado con éxito');

                    },
                    error:error
                }
            );
        }

        scope.idiomas  = <?Php echo json_encode($idiomas) ?>;

        scope.$apply();

        $(document).on("click",".idioma .new .btn",function () {

            vex.dialog.open({
                message: 'Nombre y abreviatura del idioma',
                input: [
                    '<input name="name" type="text" placeholder="Nombre..." required />',
                    '<input  name="short" type="text" placeholder="Abreviatura..." required />'
                ].join(''),
                buttons: [
                    $.extend({}, vex.dialog.buttons.YES, { text: 'Aceptar' }),
                    $.extend({}, vex.dialog.buttons.NO, { text: 'Cancelar' })
                ],
                callback: function (data) {

                    if(data)
                    {
                
                        scope.idioma=data;

                        saveIdioma();

                        //submit
                    }

                }
            })
            /*var content=  $(".new .content");
        content.stop();
         content.slideToggle();
        */});

    });
</script>
<div class="idioma fila">
    <h3 class="title">Idiomas del sitio </h3>
    <h4 class="subtitle">Haga click para elegir el predeterminado</h4>
    <ul class="table">
        <li data-ng-click="selectPredeterminado(i)" data-ng-repeat="i in idiomas" ><a class="td s12 m4 l3 animated">
                <span class="default"><i class="fa fa-star" data-ng-if="i.predeterminado==1" aria-hidden="true"></i></span>
                <span class="name">
                    {{i.name}}
                </span>
                -
                <span class="short">
                    {{i.short}}
                </span>
            </a>
        </li>
    </ul>
   <form class="new" data-ng-submit="saveLanguage()">

           <button  class="btn">Nuevo idioma</button>

      
   </form>

</div>