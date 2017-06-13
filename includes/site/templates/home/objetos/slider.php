<?php
$bloqId=1;
$bloque=$portada->getAnexos()[$bloqId];

$sliderGroupId=1;
$version="original";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>

<div class="slider-container">

    <!-- Swiper -->

       <div class="swiper-container">
           <div class="swiper-wrapper">
               <?php



               foreach ($bloque as $k=>$v)
               {
                   $v = $GLOBALS["postDAO"]->selectPostById($v->getId());

                   $archivos = $v->getArchivos();

                   $archivo = reset($archivos[$sliderGroupId]);

                   if($archivo[$version])
                   {
                       $archivo = $archivo[$version];
                   }
                   else
                   {
                       $archivo = $archivo["original"];
                   }



                       ?>
               <div class="swiper-slide" data-n="<?php echo $k?>" data-title="<?php echo $v->getTitulo();?>">
                   <figure>
                       <img src="<?php echo $archivo->getRealName();?>">
                   </figure>
               </div>

               <?php


               }
               ?>

           </div>
       </div>

    <?php

    $firstSlide=reset($bloque);

    ?>
    <div class="slider-title">

           <div class="content">
               <figure class="profile">
                   <img src="http://www2.mmu.ac.uk/media/mmuacuk/content/images/health-professions/student-profile-simone-bianchi-piantini.jpg">
                   <figcaption>
                       <h3 class="name"><a>@robertoGomezBolanos</a></h3>
                   </figcaption>
               </figure>

               <div class="line"></div>

               <h2 class="title">

                   <span class="text"><?php echo  $firstSlide->getTitulo();?></span>

               </h2>
           </div>


        </div>


    <span class="slider-tag">
        Internacionales
    </span>
  


</div>


<!-- Swiper JS -->
<script src="../dist/js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
$(document).ready(
    function () {

        var slides=<?php  echo json_encode($bloque);?>;



        var swiper = new Swiper('.swiper-container',
            {
                slidesPerView: 1,
                effect:"fade",
                autoplay:2000,
                onSlideChangeStart:function (e) {
                    
                    $(".slider-title .text").html(slides[e.activeIndex].titulo);
                }
            });
    }
);
</script>