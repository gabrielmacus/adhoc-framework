<script>


    angular.element(function () {

        scope.repositorios = <?php echo json_encode($repositorios)?>;


    });

    $(document).on("click",".item",function () {
        $(this).find(".content").stop();
        $(this).find(".content").slideToggle();
    })
</script>
<header>
    <h2 class="title"><?php echo $lang["repositorios"]?></h2>
</header>

<div class="body">

    <ul class="list">

        <li class="item" data-ng-repeat="r in repositorios">
            <a class="animated">
                <span class="name">{{r.titulo}}</span>
                <i class="fa fa-pencil icon animated" aria-hidden="true"></i>
                <i class="fa fa-trash-o icon animated" aria-hidden="true"></i>
            </a>
            <div class="content">
                aasdsa
            </div>
        </li>

    </ul>

</div>
