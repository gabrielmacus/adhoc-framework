<div class="files">

    <div class="file-preview" data-ng-repeat="p in previews">
<!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
        <div class="file" >

            <figure>
                <img data-src="{{p.url}}">
            </figure>

            <span class="name">{{p.name}}</span>
            <span class="size">{{p.size}}</span>
        </div>

    </div>

</div>