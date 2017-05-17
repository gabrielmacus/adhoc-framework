<script>
    angular.element(function () {

        scope.idiomas  = <?Php echo json_encode($idiomas) ?>;

        scope.$apply();


    });
</script>
<div class="idioma fila">
    <h3 class="title">Idiomas del sitio </h3>
    <ul class="table">
        <li data-ng-repeat="i in idiomas" ><a class="td s12 m3 l3 animated">
                <span class="default"><i class="fa fa-star" aria-hidden="true"></i></span>
                <span class="name">
                    {{i.name}}</span> - <span class="short">{{i.short}}</span>
            </a>
        </li>
    </ul>
   <form class="new" data-ng-submit="saveLanguage()">
       <button type="submit" class="btn">Nuevo</button>
       <div class="name">
           <input placeholder="Nombre..."  type="text" data-ng-model="idioma.name">
       </div>
       <div class="short">
           <input placeholder="Abreviatura..." class="short" type="text" data-ng-model="idioma.short">
       </div>
      
   </form>

</div>