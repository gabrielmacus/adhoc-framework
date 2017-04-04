

<script>



    function loadSecciones() {
        $.ajax(
            {
                "method":"post",
                "url":"load.php",
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

        if ($(this).closest(".secciones").length == 0) {
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




<h3>Secciones</h3>

<form id="add-seccion" >

    <div>
        <label>Nombre</label>
        <input name="nombre" type="text">
    </div>

    <div>
        <label>Pertenece a <b id="pertenece-a">ninguna seccion</b></label>
    </div>
    <input name="tipo" hidden value="0">
    <button type="submit">Agregar seccion</button>
</form>

</form>


<div class="secciones-wrapper">


</div>







