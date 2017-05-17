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


       <div class="content">
           <div class="name form-block s12 m4 l5 padding">
               <input placeholder="Nombre..."  type="text" data-ng-model="idioma.name">
           </div>
           <div class="short  form-block  m4 l5 padding">
               <input placeholder="Abreviatura..." type="text" data-ng-model="idioma.short">
           </div>

           <button  style="width: 100%;" class="btn s12 m4 l2">Nuevo</button>

       </div>


      
   </form>

</div>