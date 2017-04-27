<div class="files">

    <div class="file-preview fila" data-ng-repeat="p in previews" data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'">
        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
        <div class="file" >

            <figure>
                <img data-ng-src="{{p.url}}">
            </figure>

            <input class="name" data-ng-model="p.name">
            <span class="size"  data-ng-bind="getMb(p.size)"></span>
        </div>

    </div>

</div>