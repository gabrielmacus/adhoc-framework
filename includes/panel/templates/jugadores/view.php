<?php $a=$post->getArchivos();

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
        <li class="item animated"><a><strong>DNI:</strong> <span style="font-weight: 300"><?php echo $post->getBajada()?></span></a></li>
        <li class="item animated "><a><strong>Edad:</strong>
                <span style="font-weight: 300"><?php echo $post->getExtra1()?></span></a>
            </li>
        <li class="item animated">
            <a><strong>Email:</strong>
                <span style="font-weight: 300">><?php echo $post->getExtra3()?></span></a>
        </li>
        <li class="item animated "><a>
                <strong>Categoría:</strong>
               <span style="font-weight: 300"><?php echo $seccion->getNombre()?></span>
            </a></li>
    </ul>
</div>