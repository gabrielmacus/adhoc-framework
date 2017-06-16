

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
                <select name="seccion">
                    <option>-</option>
                    <?php
                    foreach ($secciones as $seccion)
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
                <select name="adjuntos">
                    <option>-</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-block s12 m6 l4">
                <label>Con anexos</label>
                <select name="anexos">
                    <option>-</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>


        </div>

    </div>
  
</form>

<script>

    $(document).on("click",".search-action",function () {


       var query= $(".search-form").serialize()+"&<?php echo http_build_query($_GET);?>";

        console.log(query);
    });

    $(document).on("click",".search-plus,.search-minus",function () {


        $(".search-plus").toggle();
        $(".search-minus").toggle();
        $(".advanced-filters").stop();
        $(".advanced-filters").slideToggle();


    });


</script>