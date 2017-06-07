
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>


<!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <figure>
                <img src="http://www.markgray.com.au/images/gallery/large/desert-light.jpg">
            </figure>

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
                slidesPerView: 1
            });
    }
);
</script>