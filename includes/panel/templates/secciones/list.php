
<script>
    angular.element(function () {

        scope.secciones=<?php    echo json_encode($secciones)?>;
console.log(scope.secciones);
scope.$apply();

$(document).on("click",".add-seccion",function () {

    var HTML="<li>";
    HTML+="<div class='form-block'>";
    HTML+="<input type='text'>"
    HTML+="</div>";
    HTML+="</li>";

});

    });
</script>

<header>
    <h2><?php echo $lang["secciones"]?></h2>
</header>
<script type="text/ng-template" id="categoryTree">
    <span>{{ seccion.nombre }}</span>
    <i class="fa fa-plus-square-o icon add-seccion" aria-hidden="true"></i>
    <i class="fa fa-trash icon" aria-hidden="true"></i>
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
