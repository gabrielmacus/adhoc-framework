<?php $a=$post->getArchivos();
var_dump($subsecciones);
;?>
<header>
    <h2>Jugador #<?php echo $post->getId()?></h2>
</header>
<div class="fila center" style="margin-top: 20px">
    <figure>
        <img style="width: 100%;height: 200px;object-fit: contain" src="<?php echo reset($a[0])["original"]->getRealName()?>">
    </figure>
</div>

<div class="body">
    <h3 style="font-size: 30px"><?php echo $post->getTitulo()?> <?php echo $post->getVolanta()?></h3>
    <ul class="list">
        <li class="item animated s12 m6 l6"><a>DNI: <?php echo $post->getBajada()?></a></li>
        <li class="item animated s12 m6 l6"><a>Edad: <?php echo $post->getExtra1()?></a></li>
        <li class="item animated s12 m12 l12"><a>Email: <?php echo $post->getExtra3()?></a></li>
    </ul>
</div>