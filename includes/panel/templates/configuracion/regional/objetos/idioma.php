<script>
    angular.element(function () {

        scope.idiomas  = <?Php echo json_encode($idiomas)?>;

        cp
    });
</script>
<div class="idioma fila">
    <h3 class="title">Idiomas del sitio</h3>
    <ul class="table">
        <li data-ng-repeat="i in idiomas" ><a class="td s12 m3 l3 animated"><span class="name">{{i.name}}</span> - <span class="short">{{i.short}}</span> </a></li>
    </ul>
 
</div>