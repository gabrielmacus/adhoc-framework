<script>
    angular.element(function () {

        scope.idiomas  = <?Php echo json_encode($idiomas) ?>;

        scope.$apply();

        $(document).on("click",".idioma .new .btn",function () {
        var content=  $(".new .content");
        content.stop();
         content.slideToggle();
        });

    });
</script>
<div class="idioma fila">
    <h3 class="title">Idiomas del sitio </h3>
    <ul class="table">
        <li data-ng-repeat="i in idiomas" ><a class="td s12 m3 l3 animated">
                <span class="default"><i class="fa fa-star" data-ng-if="i.predeterminado" aria-hidden="true"></i></span>
                <span class="name">
                    {{i.name}}</span> - <span class="short">{{i.short}}</span>
            </a>
        </li>
    </ul>
   <form class="new" data-ng-submit="saveLanguage()">

           <button  style="width: 100%;" class="btn">Nuevo</button>



           <div class="name form-block s12 m6 l6 padding">
               <input placeholder="Nombre..."  type="text" data-ng-model="idioma.name">
           </div>
           <div class="short  form-block  m6 l6 padding">
               <input placeholder="Abreviatura..." type="text" data-ng-model="idioma.short">
           </div>


      
   </form>

</div>