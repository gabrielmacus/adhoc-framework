<form  class="fila padding" >
    
    <div class="filters">
        <div class="form-block s12 m6 l6 search" >
            <label>Buscar por texto</label>
            <input type="text" name="q">
            <a class="search-action animated" ><i class="fa fa-search" aria-hidden="true"></i>
            </a>
            <a class="search-plus animated"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
            <a class="search-minus animated" style="display: none"><i class="fa fa-search-minus" aria-hidden="true"></i></a>
        </div>
    </div>
  
</form>

<script>
    $(document).on("click",".search-plus,.search-minus",function () {


        $(".search-plus").toggle();
        $(".search-minus").toggle();


    });


</script>