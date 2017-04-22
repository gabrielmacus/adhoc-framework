
<script>
    $(document).on("click",".item",openSubmenu);

    function openSubmenu(e) {

        var item = $(e.target).closest(".item");
        if(item)
        {
            item.stop();

            item.find("ul").animate({height:"toggle"},function () {
                item.toggleClass("active");

            });

        }


       })


    }

</script>

<ul class="sidenav main-color">


    <li class="title"><a><?php echo $configuracion->getSiteName()." ".$configuracion->getVersion() ?></a></li>
    <li class="item animated">
        <a>
            <span class="icon honey-flower"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
            <span class="text">Item 1</span>
        </a>

        <ul style="display: none" class="main-color">

            <li  class="item animated">
                <a>
                    <span class="icon saffron"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
                    <span class="text ">Submenu 1</span>
                </a>
            </li>
            <li class="item animated">
                <a>
                    <span class="icon shamrock"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
                    <span class="text ">Submenu 2</span>
                </a>
            </li>

        </ul>

    </li>
    <li  class="item animated">
        <a>
            <span class="icon saffron"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
            <span class="text ">Item 2</span>
        </a>
    </li>
    <li class="item animated">
        <a>
            <span class="icon shamrock"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
            <span class="text ">Item 2</span>
        </a>
    </li>

</ul>