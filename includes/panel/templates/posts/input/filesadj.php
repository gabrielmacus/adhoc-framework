<script>
    angular.element(function () {
        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

        scope.removeAdjunto=function (a) {

            a.delete=true;

        }
        // Listen to message from child window
        eventer(messageEvent,function(e) {
            console.log(e);
            if(e.origin == "<?php echo $configuracion->getSiteAddress()?>")
            {

                if(!scope.post.archivos)
                {
                    scope.post.archivos=[];
                }
                $.each(e.data,function (k,v) {

                    if(v.archivo_grupo==<?php echo $grupo?>)
                    {
                        scope.post.archivos.push(v);
                    }

                });
              setTimeout(function () {
                  scope.$apply();
              });

            }
        },false);
    });


</script>
<style>
    .adjuntos
    {
        padding: 10px;
    }

    .adjunto-wrapper
    {
        padding: 15px;
    }

    .adjuntos .adjunto
    {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.10);
        padding: 10px;
    }
</style>
<div class="fila adjuntos">
    <label class="fila" style="margin-bottom: 10px;"><?php echo $label;?></label>

    <div class="s12 m6 l4 padding adjunto-wrapper" style="position: relative" data-ng-repeat="a in post.archivos" data-ng-if="a.archivo_grupo==<?php echo $grupo;?>" data-ng-hide="a.delete">

        <span data-ng-click="removeAdjunto(a)" style="font-size:30px;cursor: pointer;position: absolute;top:5px;right:5px;color: rgba(220, 69, 47, 1)">
            <i class="fa fa-times" aria-hidden="true"></i>
        </span>

        <figure style="height: 150px;width: 100%">
            <img data-ng-src="{{a.url}}" style="height: 100%;width: 100%;object-fit: cover">
        </figure>
        <div class="adjunto">
            <span class="name" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis">{{a.name}}</span>
        </div>

    </div>
    <div class="fila">
        <a  data-lity  style="display: block;color: white!important;;" class="fila btn" href="<?php echo $configuracion->getSiteAddress()?>/admin/repositorios/?modal=true&grupo=<?php echo $grupo?>">Adjuntar archivo</a>
    </div>


</div>