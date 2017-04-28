<div class="files">

    <div  class="file-preview fila animation bouncy-scale-in" style="padding: 0;margin-top: 10px!important;" data-ng-repeat="p in previews" data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'">
        <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
        <div class="file" >

            <figure>
                <img data-ng-src="{{p.url}}">
            </figure>
            <i class="delete fa fa-times" data-ng-click="deletePreview(p)" aria-hidden="true"></i>
        </div>

    </div>

</div>
<style>
    .animate-enter,
    .animate-leave
    {
        -webkit-transition: 400ms cubic-bezier(0.250, 0.250, 0.750, 0.750) all;
        -moz-transition: 400ms cubic-bezier(0.250, 0.250, 0.750, 0.750) all;
        -ms-transition: 400ms cubic-bezier(0.250, 0.250, 0.750, 0.750) all;
        -o-transition: 400ms cubic-bezier(0.250, 0.250, 0.750, 0.750) all;
        transition: 400ms cubic-bezier(0.250, 0.250, 0.750, 0.750) all;
        position: relative;
        display: block;
        overflow: hidden;
        text-overflow: clip;
        white-space:nowrap;
    }

    .animate-leave.animate-leave-active,
    .animate-enter {
        opacity: 0;
        width: 0px;
        height: 0px;
    }

    .animate-enter.animate-enter-active,
    .animate-leave {
        opacity: 1;
        width: 150px;
        height: 30px;
    }

</style>