
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
    {{ category.title }}
    <ul ng-if="value.items">
        <li ng-repeat="category in value.items" ng-include="'categoryTree'">
            {{category}}
        </li>
    </ul>
</script>

<ul>
    <li data-ng-repeat="(key,value) in secciones"  ng-include="'categoryTree'"></li>
</ul>
<div class="body">

    <ul class="list">
        <li></li>
    </ul>

</div>
