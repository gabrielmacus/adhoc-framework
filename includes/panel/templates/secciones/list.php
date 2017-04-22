
<script>
    angular.ready(function () {
        scope.secciones=<?php    echo json_encode($secciones)?>;


    });
</script>
<header>
    <h2><?php echo $lang["secciones"]?></h2>
</header>
<script type="text/ng-template" id="field_renderer.html">
    {{data.label}}
    <ul>
        <li ng-repeat="(key,value) in secciones" ng-include="'field_renderer.html'">{{value}}</li>
    </ul>
</script>
<ul >
    <li ng-repeat="(key,value) in secciones" ng-include="'field_renderer.html'">{{value}}</li>
</ul>


<div class="body">

    <ul class="list">
        <li></li>
    </ul>

</div>
