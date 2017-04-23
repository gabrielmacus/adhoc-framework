<script>
    $(document).on("click",".content",function () {
        $(this).stop();
        $(this).animate({height:"toggle"})
    })
</script>
<header>
    <h2 class="title"><?php echo $lang["repositorios"]?></h2>
</header>

<div class="body">

    <ul class="list">
        <li class="item">
            <a class="animated">
                <span class="name">Repositorio 1</span>
                <i class="fa fa-pencil icon animated" aria-hidden="true"></i>
                <i class="fa fa-trash-o icon animated" aria-hidden="true"></i>
            </a>
            <div class="content">
                aasdsa
            </div>
        </li>
        <li class="item"><a class="animated">Repositorio 2</a></li>
        <li class="item"><a class="animated">Repositorio 3</a></li>
    </ul>

</div>
