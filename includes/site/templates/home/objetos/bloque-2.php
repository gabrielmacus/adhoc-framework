<div class="mas-vistos flex">

    <header class="top main-color">
        <h2>Lo más visto</h2>
    </header>

    <div class="slider-wrapper swiper-container">

        <div class="slider-container flex swiper-wrapper">

                <?php  for ($i=0;$i<9;$i++)
                {
                    ?>
                    <div class="image swiper-slide">
                        <figure>
                            <img class="fit" src="<?php echo $img[rand(0,(count($img)-1))];?>">
                        </figure>

                    </div>

                    <?php
                }?>


        </div>

    </div>


</div>
<!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">Slide 1</div>
        <div class="swiper-slide">Slide 2</div>
        <div class="swiper-slide">Slide 3</div>
        <div class="swiper-slide">Slide 4</div>
        <div class="swiper-slide">Slide 5</div>
        <div class="swiper-slide">Slide 6</div>
        <div class="swiper-slide">Slide 7</div>
        <div class="swiper-slide">Slide 8</div>
        <div class="swiper-slide">Slide 9</div>
        <div class="swiper-slide">Slide 10</div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>
<script>
    $(document).ready(
        function () {
            var swiper = new Swiper('.swiper-container', {

                slidesPerView: 4,
                paginationClickable: true,
                spaceBetween: 30
            });
        }
    );
</script>