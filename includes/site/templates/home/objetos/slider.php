<?php
$bloqId=1;
$bloque=$portada->getAnexos()[$bloqId];
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>

<div class="slider-container">

    <!-- Swiper -->
   <?php
   foreach ($bloque as $k=>$v)
   {


  echo "<pre>". var_dump($v->getArchivos())."</pre>";



       ?>
       <div class="swiper-container">
           <div class="swiper-wrapper">
               <div class="swiper-slide" data-n="<?php echo $k?>" data-title="<?php echo $v->getTitulo();?>">
                   <figure>
                       <img src="http://www.markgray.com.au/images/gallery/large/desert-light.jpg">
                   </figure>
               </div>
               <div class="swiper-slide">
                   <figure>
                       <img src="http://digital-photography-school.com/wp-content/uploads/flickr/205125227_3f160763a0_o.jpg">
                   </figure>
               </div>

           </div>
       </div>
       <?php
   }
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

                   <span class="text">Bordet y la paritaria: "Vamos a mejorar sustancialmente la propuesta salarial"</span>

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
        var swiper = new Swiper('.swiper-container',
            {
                slidesPerView: 1,
                effect:"fade"
            });
    }
);
</script>