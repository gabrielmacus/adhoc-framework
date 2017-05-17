<script>
    angular.element(function () {

        scope.idiomas  = <?Php echo json_encode($idiomas) ?>;

        scope.$apply();

        $(document).on("click",".idioma .new .btn",function () {

            vex.dialog.open({
                message: 'Nombre y abreviatura del idioma',
                input: [
                    '<input data-ng-model="idioma.name" type="text" placeholder="Nombre..." required />',
                    '<input  data-ng-model="idioma.short" type="text" placeholder="Abreviatura..." required />'
                ].join(''),
                buttons: [
                    $.extend({}, vex.dialog.buttons.YES, { text: 'Aceptar' }),
                    $.extend({}, vex.dialog.buttons.NO, { text: 'Cancelar' })
                ],
                callback: function (data) {

                    //submit
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
    <h4>Haga click para elegir el predeterminado</h4>
    <ul class="table">
        <li data-ng-repeat="i in idiomas" ><a class="td s12 m3 l3 animated">
                <span class="default"><i class="fa fa-star" data-ng-if="i.predeterminado" aria-hidden="true"></i></span>
                <span class="name">
                    {{i.name}}</span> - <span class="short">{{i.short}}</span>
            </a>
        </li>
    </ul>
   <form class="new" data-ng-submit="saveLanguage()">

           <button  class="btn">Nuevo idioma</button>

      
   </form>

</div>