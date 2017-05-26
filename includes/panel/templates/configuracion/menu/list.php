<script>
    angular.element(function () {

        scope.list=[
            {
                "id": 3,
                "title": "node3",
                "nodes": [
                    {
                        "id": 31,
                        "title": "node3.1",
                        "nodes": [
                            {
                                "id": 310,
                                "title": "node3.1.1",
                                "nodes": []
                            }
                        ]
                    }
                ]
            }
        ]

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