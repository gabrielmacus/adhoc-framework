<div class="files">

    <div class="file-preview" data-ng-repeat="p in previews">

        <div class="file" data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'">

            <figure>
                <img data-src="{{p.url}}">
            </figure>

            <span class="name">{{p.}}</span>
            <span class="size">{{p.size}}</span>
        </div>

    </div>

</div>