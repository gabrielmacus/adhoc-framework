

<form  method="get" action="?"  class="fila padding search-form" >
    
    <div class="filters">
        <div class="form-block s12 m6 l6 search" >
            <label>Buscar por texto</label>
            <input type="text" name="q">
            <a  class="search-action" ><i class="fa fa-search" aria-hidden="true"></i>
            </a>
            <a class="search-plus "><i class="fa fa-search-plus" aria-hidden="true"></i></a>
            <a class="search-minus " style="display: none"><i class="fa fa-search-minus" aria-hidden="true"></i></a>
        </div>
        <div class="advanced-filters fila" style="display: none">
            <div class="form-block s12 m6 l4">
                <label>Buscar por sección</label>
                <select name="t">
                    <option value="">-</option>
                    <?php

                    $seccionesBreadcrumb=array_reverse($seccionesBreadcrumb);

                    foreach ($seccionesBreadcrumb as $seccion)
                    {
                        ?>
                        <option value="<?php echo $seccion->getId();?>"><?php echo $seccion->getNombre();?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-block s12 m6 l4">
                <label>Con archivos adjuntos</label>
                <select name="adj">
                    <option value="">-</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-block s12 m6 l4">
                <label>Con anexos</label>
                <select name="anx">
                    <option value="">-</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>


        </div>

    </div>
  
</form>

<script>

    $(document).ready(
        function () {

            $("[name='q']").val("<?php echo $_GET["q"]?>");
            $("[name='adj']").val("<?php echo $_GET["adj"]?>");
            $("[name='anx']").val("<?php echo $_GET["anx"]?>");
            $("[name='t']").val("<?php echo $_GET["t"]?>");
            <?php
            if( $_GET["anx"] ||  $_GET["adj"])
            {
                ?>
            $(".search-plus").click();
            <?php
            }
            ?>
        }

    );

    var q = <?php echo json_encode($_GET);?>;
    $(document).on("click",".search-action",function () {

        var array=$(".search-form").serializeArray();
        var query="";
        $.each(array,function (k,v) {

            console.log(v.name);
            if(v.name!="t")
            {
                delete q[v.name];
            }

           if(v.value!="")
           {
               query+=v.name+"="+v.value+"&";
           }

        });

        $.each(q,function (k,v) {
            query+=k+"="+v+"&";
        });

        var url = location.origin+location.pathname+"?"+query;

        return false;
        location.href=url;
    });




    $(document).on("click",".search-plus,.search-minus",function () {


        $(".search-plus").toggle();
        $(".search-minus").toggle();
        $(".advanced-filters").stop();
        $(".advanced-filters").slideToggle();


    });


</script>