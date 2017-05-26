<script>
    angular.element(function () {

        scope.data=<?php echo json_encode($menu)?>;

        scope.$apply();
    });

</script>



<!-- Nested node template -->
<script type="text/ng-template" id="nodes_renderer.html">
    <div ui-tree-handle>
        {{node.title}}
    </div>
    <ol ui-tree-nodes="" ng-model="node.nodes">
        <li ng-repeat="node in node.nodes" ui-tree-node ng-include="'nodes_renderer.html'">
        </li>
    </ol>
</script>
<div ui-tree>
    <ol ui-tree-nodes="" ng-model="data" id="tree-root">
        <li ng-repeat="node in data" ui-tree-node ng-include="'nodes_renderer.html'"></li>
    </ol>
</div>