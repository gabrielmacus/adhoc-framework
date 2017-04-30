<script>
    angular.element(function () {

    });
</script>
<div class="fila">

    <div class="s12 m4 l4" data-ng-repeat="a in archivos" data-ng-if="a.archivo_grupo==<?php echo $grupo;?>">
        <span class="name">{{}}</span>
    </div>

    <div class="adjuntar">
        Adjuntar archivo
    </div>

</div>