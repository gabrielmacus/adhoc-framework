<script>
    angular.element(function () {
        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

        scope.removeAnexo=function (a) {

            a.delete=true;

        }
        // Listen to message from child window
        eventer(messageEvent,function(e) {
            console.log(e);
            if(e.origin == "<?php echo $configuracion->getSiteAddress()?>")
            {

                if(!scope.post.anexos)
                {
                    scope.post.anexos=[];
                }

                $.each(e.data,function (k,v) {


                    if(v.post_nexo_grupo=="<?php echo $grupo?>")
                    {
                        scope.post.anexos.push(v);
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

    <div class="fila">
        <a  data-lity  style="display: block;color: white!important;;" class="fila btn" href="<?php echo $configuracion->getSiteAddress()?>/admin/posts/?modal=true&grupo=<?php echo $grupo?>&t=<?php echo $tipo?>&s=<?php echo $s?>">Adjuntar anexos</a>
    </div>


</div>