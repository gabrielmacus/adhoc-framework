<style>


   .navbar ul
    {
        list-style:none;
        position:relative;
        float:left;
        margin:0;
        padding:0
    }

   .navbar ul a
    {


        display:block;
        color:white!important;
        text-decoration:none;
        font-size:19px;
        /*line-height:32px;*/
        /*padding:0 18px;*/
    }

   .navbar ul li
    {
        -webkit-transition: all 300ms;
        -moz-transition: all 300ms;
        -ms-transition: all 300ms;
        -o-transition: all 300ms;
        transition: all 300ms;
        position:relative;
        float:left;
        margin:0;
        padding:25px 20px 25px 20px;
    }

   .navbar ul li.active
    {
        background:#ddd

    }
   .navbar ul li.active a
    {
        color: black!important;

    }
   .navbar ul li:hover a
    {
        color: black!important;
    }
   .navbar ul li:hover
    {
        background-color: #e8e5e5;

    }
   .navbar ul li ul li a
    {
        color: #000!important;
    }

   .navbar ul ul
    {

        display:none;
        position:absolute;
        top:100%;
        left:0;
        background:#f7f7f7;
        padding:0
    }

   .navbar ul ul li
    {
        float:none;
        width:200px
    }
    .fa-sort-desc
    {
        position: relative;
        padding: 0px!important;
        bottom: 3px;
        margin-left: 4px;
    }

   .navbar ul li ul .fa-sort-desc
    {

        -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        transform: rotate(270deg);


        position: relative;
        padding: 0px!important;
        bottom: 0px;
        margin-left: 4px;

    }




   .navbar ul ul a
    {
        line-height:120%;
        padding:10px 15px
    }

   .navbar ul ul ul
    {
        top:0;
        left:100%
    }

   .navbar ul li:hover > ul
    {
        display:block
    }


   .navbar .menu-btn
    {
        float: right;

    }
   .navbar .menu-btn li
    {
        padding: 22px;
        color: white!important;


    }
   .navbar .menu-btn li:hover i
    {
        color: black;
        font-size: 25px;

    }

   .navbar .menu-btn li i
    {
        font-size: 25px;
        cursor: pointer;
    }


   .navbar
    {
        -webkit-transition: all 500ms;
        -moz-transition: all 500ms;
        -ms-transition: all 500ms;
        -o-transition: all 500ms;
        transition: all 500ms;
        float: left;
        width: 100%;
        background-color: rgba(22, 22, 22, 0.84);

    }
    .logo
    {
        width:50px;float: left;
    }
    .text
    {
        position: relative;    bottom: -10px;
        margin-left: 20px;
        font-size: 30px;
        float: left
    ;
    }


</style>

<?php
function loadNavbar($navbar)
{

    ?>
    <ul>
        <?php
        foreach ($navbar as $item)
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
            $logo =$item["logo"];


            ?>
            <li class="<?php echo $class;?>"><a href="<?php echo $href;?>">

                    <?php if($logo)
                    {
                        ?>
                        <img class="logo" src="<?php  echo $logo?>">
                        <?php
                    }?>

                    <h1 class="text"><?php echo $text;?></h1>


                    <?php if($hasSubmenu)
                    {
                        ?><i class="fa fa-sort-desc" aria-hidden="true"></i>
                        <?php
                    }?>


                </a>
                <?php if($hasSubmenu)
                {
                    loadNavbar($item["items"]);
                }?>
            </li>
            <?php
        }
        ?>

    </ul>




    <?php


}



?>


<nav class="navbar">
    <?php loadNavbar($lang["navbar"]);?>
    <!--
    <ul class="menu-btn">
        <li><i class="fa fa-bars" aria-hidden="true"></i></li>
    </ul>-->
</nav>
