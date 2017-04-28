<div class="files">

    <div class="file-preview fila" style="padding: 0;margin-top: 10px!important;" data-ng-repeat="p in previews" data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'">
        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
        <div class="file" >

            <figure>
                <img data-ng-src="{{p.url}}">
            </figure>
            <i class="delete fa fa-times" data-ng-click="deletePreview(p)" aria-hidden="true"></i>
        </div>

    </div>

</div>