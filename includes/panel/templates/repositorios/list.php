<form>
    <div></div>
</form>

<ul class="repositorios">
    <?php

    foreach ($repositorios as $r)
    {
        $r->getId();
        $r->getCreation();
        $r->getDatePath();
        $r->getHost();
        $r->getName();
        $r->getUser();
        $r->getPort();
        $r->getPath();
        $r->getDatePath();


        ?>

        <li>
            <h3><span><?php echo $r->getName();?></span></h3>
            <span><?php echo "#".$r->getId();?></span> <span><?php echo  date($lang["dateFormat"],  $r->getCreation())?></span>
            <span><?php echo $r->getHost();?></span>
            <span><?php echo $r->getUser();?></span>
        </li>

        <?php
    }?>
</ul>
