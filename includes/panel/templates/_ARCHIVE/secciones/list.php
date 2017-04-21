

<script>



    function loadSecciones() {
        $.ajax(
            {
                "method":"post",
                "url":"<?php echo $configuracion->getSiteAddress()?>/admin/secciones/load.php",
                "success":function (e) {
                  $(".secciones-wrapper").html(e);
                }
                ,"error":error
            }
        );
    }


    $(document).ready(
        function () {
            loadSecciones();
        }
    );
    $(document).on("click",function (e) {

        if ($(e.target).closest(".secciones").length == 0 &&
            $(e.target).closest("input").length == 0  &&
            $(e.target).closest("button").length == 0 ) {


            $("[name='tipo']").val(0);
            $("#pertenece-a").html("ninguna seccion");
        }


    });
        $(document).on("click",".delete-seccion",function (e) {

        var li= $(this).closest("li");
        var id= li.data("id");

        $.ajax(
            {
                "method":"post",
                "url":"delete.php",
                "data":{id:id},
                "dataType":"json",
                "success":function (e) {
                    if(e)
                    {
                        loadSecciones();
                    }
                }
                ,"error":error
            }
        );

        e.stopPropagation();

    });

    $(document).on("click",".secciones li",function (e) {

       var li= $(this).closest("li");
        var id= li.data("id");
        var nombre = li.data("nombre");

        li.addClass("active");
        $("[name='tipo']").val(id);
        $("#pertenece-a").html(nombre);
        e.stopPropagation();

    });
        $(document).on("submit","#add-seccion",function (e) {

        e.preventDefault();
        $.ajax(
            {
                "method":"post",
                "url":"add.php",
                "data":$(this).serialize(),
                "dataType":"json",
                "success":function (e) {
                    loadSecciones();
                }
                ,"error":error
            }
        );

    });


</script>





<form id="add-seccion">

    <div>
        <label>Nombre</label>
        <input name="nombre" type="text">
    </div>
    <div >
        <button type="submit">Agregar seccion</button>

    </div>
    <div>
        <label>Pertenece a <b id="pertenece-a">ninguna seccion</b></label>
    </div>

    <input name="tipo" hidden value="0">


    <div  class="secciones-wrapper">


    </div>


</form>
<style>
    .secciones li
    {
        padding-left: 10px;



    }
    .secciones
    {
        background: white;
        padding-top: 20px;
        width: 100%;float: left;

    }

    .secciones-wrapper
    {
     float: left;width: 100%;
    }
</style>








