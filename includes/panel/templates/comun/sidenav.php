
<script>
    $(document).on("click","[data-level-trigger]",openSidenav);

    function openSidenav() {
        
    
    console.log(    $("[data-level]:visible"));


   // $("[data-level='"+$(this).data("level-trigger")+"']").fadeIn();

    }

</script>

<ul class="sidenav main-color">


    <li data-level="1" class="title"><a><?php echo $configuracion->getSiteName()." ".$configuracion->getVersion() ?></a></li>
    <li data-level="1" data-level-trigger="2" class="item animated">
        <a>
            <span class="icon honey-flower"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
            <span class="text">Item 1</span>
            <ul class="sidenav main-color">

                <li class="item animated">
                    <a>
                        <span class="icon honey-flower"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
                        <span class="text">Item 1</span>
                        <ul class="sidenav main-color">


                            <li class="title"><a><?php echo $configuracion->getSiteName()." ".$configuracion->getVersion() ?></a></li>
                            <li class="item animated">
                                <a>
                                    <span class="icon honey-flower"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
                                    <span class="text">Item 1</span>
                                    <ul class="sidenav main-color">

                                        <li class="item animated">
                                            <a>
                                                <span class="icon honey-flower"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
                                                <span class="text">Item 1</span>

                                            </a>
                                        </li>
                                        <li class="item animated">
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


                                </a>
                            </li>
                            <li class="item animated">
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
                    </a>
                </li>
                <li class="item animated">
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


        </a>
    </li>
    <li data-level="1" class="item animated">
        <a>
            <span class="icon saffron"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
            <span class="text ">Item 2</span>
        </a>
    </li>
    <li data-level="1" class="item animated">
        <a>
            <span class="icon shamrock"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
            <span class="text ">Item 2</span>
        </a>
    </li>

    <li data-level="2" class="item animated"><a>
            <span class="icon shamrock"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
            <span class="text ">Item 2</span>
        </a></li>
    <li data-level="2"  class="item animated"><a>
            <span class="icon shamrock"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
            <span class="text ">Item 2</span>
        </a></li>
</ul>