
<script>
    angular.element(function () {

        scope.secciones=<?php    echo json_encode($secciones)?>;
console.log(scope.secciones);
scope.$apply();

    });
</script>
<header>
    <h2><?php echo $lang["secciones"]?></h2>
</header>
<script type="text/ng-template" id="categoryTree">

    <ul ng-if="value.secciones">
        <li ng-repeat="category in value.secciones" ng-include="'categoryTree'">{{ value.nombre }}
        </li>
    </ul>
</script>

<ul>
    <li data-ng-repeat="(key,value) in secciones"  ng-include="'categoryTree'">{{ value.nombre }}</li>
</ul>
<div class="body">

    <ul class="list">
        <li></li>
    </ul>

</div>
