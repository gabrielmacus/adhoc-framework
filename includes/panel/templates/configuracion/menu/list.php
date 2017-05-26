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
                        "nodes": []
                    }
                ]
            }
        ];

        scope.$apply();
    });

</script>
<div ui-tree>
    <ol ui-tree-nodes="" ng-model="list">
        <li ng-repeat="item in list" ui-tree-node>
            <div ui-tree-handle>
                {{item.title}}
            </div>
            <ol ui-tree-nodes="" ng-model="item.nodes">
                <li ng-repeat="subItem in item.nodes" ui-tree-node>
                    <div ui-tree-handle>
                        {{subItem.title}}
                    </div>
                </li>
            </ol>
        </li>
    </ol>
</div>
