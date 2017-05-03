<script>
    angular.element(function () {
        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

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
        padding: 20px;
    }
    .adjunto-wrapper
    {
        padding: 15px;
    }

    .adjuntos .adjunto
    {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.10);
    }
</style>
<div class="fila adjuntos">
    <label class="fila" style="margin-bottom: 10px;"><?php echo $label;?></label>

    <div class="s12 m4 l4 adjunto-wrapper" data-ng-repeat="a in post.archivos" data-ng-if="a.archivo_grupo==<?php echo $grupo;?>">

        <div class="adjunto">
            <span class="name">{{a.name}}</span>
        </div>

    </div>
    <div class="fila">
        <a  data-lity  style="display: block" class="fila btn" href="<?php echo $configuracion->getSiteAddress()?>/admin/repositorios/?modal=true&grupo=<?php echo $grupo?>">Adjuntar archivo</a>
    </div>


</div>