<div class="files">

    <div class="file-preview s12 m6 l4" data-ng-repeat="p in previews" data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'">
<!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
        <div class="file" >

            <figure>
                <img data-ng-src="{{p.url}}">
            </figure>

            <span class="name" data-ng-bind="getMb(p.name)"></span>
            <span class="size">{{p.size}}</span>
        </div>

    </div>

</div>