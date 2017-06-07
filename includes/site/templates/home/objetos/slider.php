
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>

<div class="slider-container">

    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
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

    <div class="slider-bar">
        <div class="slider-title">
            <h2>Titulo del slider de prueba</h2>
        </div>
    </div>

  


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