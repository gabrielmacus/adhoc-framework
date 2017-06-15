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
                    <option>A</option>
                </select>
            </div>

            <style>
                .checkboxes label {
                    display: block;
                    float: left;
                    padding-right: 10px;
                    white-space: nowrap;
                }
                .checkboxes input {
                    vertical-align: middle;
                }
                .checkboxes label span {
                    vertical-align: middle;
                }
            </style>

            <div class="form-block s12 m6 l4">
                <label>Con archivos</label>
            </div>
            <div class="form-block s12 m6 l4">
                <form>
                    <div class="checkboxes">
                        <label for="x"><input type="checkbox" id="x" /> <span>Label text x</span></label>
                        <label for="y"><input type="checkbox" id="y" /> <span>Label text y</span></label>
                        <label for="z"><input type="checkbox" id="z" /> <span>Label text z</span></label>
                    </div>
                </form>
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