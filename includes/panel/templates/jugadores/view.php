<?php $a=$post->getArchivos();

var_dump($a[0]);
;?>
<header>
    <h2>Jugador #<?php echo $post->getId()?></h2>
</header>
<div class="fila">
    <figure>
        <img src="">
    </figure>
</div>

<div class="body">
    <h3 style="font-size: 30px"><?php echo $post->getTitulo()?> <?php echo $post->getVolanta()?></h3>
    <ul class="list">
        <li class="item animated"><a>DNI <?php echo $post->getBajada()?></a></li>
        <li class="item animated"><a>Edad <?php echo $post->getExtra1()?></a></li>
        <li class="item animated"><a>Email <?php echo $post->getExtra3()?></a></li>
    </ul>
</div>