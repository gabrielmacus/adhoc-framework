
<?php

function loadSidenav($items)
{

    ?>
    <ul style="    width: 100%;">
        <?php
        foreach ($items as $item)
        {
            $href="";
            $class="";
            $text="";
            if(isset($item["href"]))
            {
                $href=$item["href"];
            }
            if(isset($item["class"]))
            {
                $class=$item["class"];
            }
            if(isset($item["text"]))
            {
                $text=$item["text"];
            }

            $hasSubmenu=isset($item["items"]);

            if($hasSubmenu)
            {
                $class.=" submenu";
            }


            ?>
            <li class="<?php echo $class;?>"><a href="<?php echo  $href;?>"><?php echo $text;?>
                    <?php if($hasSubmenu)
                    {
                        ?><i class="fa fa-sort-desc" aria-hidden="true"
                       ></i>
                        <?php
                    }?>
                </a>
                <?php if($hasSubmenu)
                {

                    loadSidenav($item["items"]);
                }?>
            </li>
            <?php
        }
        ?>

    </ul>




    <?php


}



?>
<script>
    $(document).on("click","li.submenu",function () {

        var ul=     $(this).find("ul");
        ul.stop();
        ul.animate({"height":"toggle"},350);

    });

    $(document).on("click",".toggle-menu",function () {

        if( $("aside.sidenav").hasClass("active"))
        {  $("#body").animate({"left":"-"+ $(".sidenav").css("width")},10);
            $("aside.sidenav").removeClass("active");
        }
        else
        {$(".sidenav").addClass("active");

            $("#body").animate({"left":"0px"},10);

        }



    });

    $(document).on("click","section",function (e) {


            $(".sidenav").addClass("active");

        $("#body").animate({"left":"0px"},400);


    });

</script>
<style>

    .sidenav{
        -webkit-transition: all 400ms;
        -moz-transition: all  400ms;;
        -ms-transition: all  400ms;;
        -o-transition: all  400ms;;
        transition: all  400ms;;
        height: 100%;
        overflow: scroll;    top: 0px;
    }

    .sidenav ul > li
    {
        font-size: 20px;

    }
    .sidenav .submenu ul
    {    width: 100%;
        float: left;
        display: none;
        overflow: hidden;
        background-color: white;
        display: none;
    }

    .sidenav .submenu  ul li:hover
    {

  padding-left: 30px;

    }

    .sidenav .submenu    ul li
    {
        -webkit-transition: all 350ms;
        -moz-transition: all 350ms;
        -ms-transition: all 350ms;
        -o-transition: all 350ms;
        transition: all 350ms;
    font-size: 18px!important;
        padding-left: 20px;
    }

    @media screen and  (min-width:1025px)  {

        #body
        {
            left:0px!important;
        }

        section
        {
            width: 75%;
        }
        .sidenav
        {
            position: fixed;
            height:100%;
            width: 25%;
            right: 0px;
            top:0px;
        }
    }    @media screen and (min-width: 769px) and (max-width:1024px)  {

        .sidenav
    {

        z-index: 2000;
        width: 30%;
        right: 0%;
    }

        .sidenav.active
        {
            position: fixed;
            height:100%;
            width: 30%;
            right: -30%;
            top:0px;
        }

        .icon-trash
        {
            position: fixed;bottom: 10px;right:5%!important; ;z-index: 5;transform: scale(2);
        }
    }

    @media screen and (min-width:601px) and (max-width:768px) { .icon-trash
    {
        position: fixed;bottom: 10px;right:5%!important; ;z-index: 5;transform: scale(2);
    }
        .sidenav
        {

            z-index: 2000;
            width: 40%;
            right: 0%;
        }
        .sidenav.active
        {
            position: fixed;
            height:100%;
            width: 40%;
            right: -40%;
            top:0px;
        }


    }
    @media screen and (max-width:600px) { .icon-trash
    {
        position: fixed;bottom: 10px;right:5%!important; ;z-index: 5;transform: scale(2);
    }
        .sidenav
        {

            z-index: 2000;
            width: 65%;
            right: 0%;
        }
        .sidenav.active
        {
            position: fixed;
            height:100%;
            width: 65%;
            right: -65%;
            top:0px;
        }
    }

</style>

    <aside class="sidenav active">    <?php echo loadSidenav($lang["sidenav"])?>
     </aside>



