<div class="modal-container">
    <div class="modal">
        <header>
            <span><?php echo $title?></span>
        </header>
        <div class="content">
            <p><?php echo $text;?></p>
            <?php
            switch ($type)
            {
                default:

                    ?>
                    <div><button>Aceptar</button></div>
                    <?php

                    break;

            }?>
        </div>
    </div>
</div>