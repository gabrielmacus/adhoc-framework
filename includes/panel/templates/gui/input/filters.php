
<form  class="fila padding" >
    
    <div class="filters">
        <div class="form-block s12 m6 l6 search" >
            <label>Buscar por texto</label>
            <input type="text" name="q">
            <a class="search-action " ><i class="fa fa-search" aria-hidden="true"></i>
            </a>
            <a class="search-plus "><i class="fa fa-search-plus" aria-hidden="true"></i></a>
            <a class="search-minus " style="display: none"><i class="fa fa-search-minus" aria-hidden="true"></i></a>
        </div>
        <div class="advanced-filters fila" style="display: none">
            <div class="form-block s12 m6 l4">
                <label>Buscar por sección</label>
                <select>
                    <?php
                    foreach ($secciones as $seccion)
                    {
                    ?>
                    <option value="<?Php echo $seccion->getId();?>"><?Php echo $seccion->getNombre();?></option>
                    <?php} ?>
                </select>
            </div>

            <div class="form-block s12 m6 l4">
                <label><input type="checkbox" /> Con archivos</label>
            </div>
            <div class="form-block s12 m6 l4">
                <label>Buscar por sección</label>
                <select>
                    <option>A</option>
                </select>
            </div>


        </div>

    </div>
  
</form>

<script>
    $(document).on("click",".search-plus,.search-minus",function () {


        $(".search-plus").toggle();
        $(".search-minus").toggle();
        $(".advanced-filters").stop();
        $(".advanced-filters").slideToggle();


    });


</script>