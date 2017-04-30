<script>
    angular.element(function () {
        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

        // Listen to message from child window
        eventer(messageEvent,function(e) {
            if(e.origin == location.href)
            {

                if(!scope.post.archivos)
                {
                    scope.post.archivos=[];
                }
                $.each(e.data,function (k,v) {
                    v.archivo_grupo=<?php echo $grupo;?>;
                    scope.post.archivos.push(v);
                });
             scope.$apply();
            }
        },false);
    });


</script>
<div class="fila">
    <label><?php echo $label;?></label>

    <div class="s12 m4 l4" data-ng-repeat="a in archivos" data-ng-if="a.archivo_grupo==<?php echo $grupo;?>">
        <span class="name">{{a.name}}</span>
    </div>

    <a data-lity class="adjuntas" href="<?php echo $configuracion->getSiteAddress()?>/admin/repositorios/?modal=true">Adjuntar archivo</a>
</div>