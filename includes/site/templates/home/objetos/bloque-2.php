
<header class="top main-color">
    <h2>Lo más visto</h2>
</header>

<div class="mas-vistos flex">

        <div class="swiper-container">
            <div class="swiper-wrapper">

                <?php  for ($i=0;$i<9;$i++)
                {
                    ?>
                    <div class="image swiper-slide">
                        <figure>
                            <img class="fit" src="<?php echo $img[rand(0,(count($img)-1))];?>">
                            <figcaption>
                                URGENTE VENDO CLIO 2 MOD. 2006. EXCELENTE ESTADO!
                            </figcaption>
                        </figure>

                    </div>

                    <?php
                }?>


            </div>
        </div>



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