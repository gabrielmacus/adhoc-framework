<script>


  

    $(document).on("click",".item",function () {
        $(this).find(".content").stop();
        $(this).find(".content").slideToggle();
    })
    $(document).on("click","#add-repositorio",function () {

        $("#new-repositorio").slideToggle();

    });
</script>
<header>
    <h2 class="title">Configuración regional</h2>
</header>

<div class="body">

    <?php include "objetos/idioma.php"?>

</div>
