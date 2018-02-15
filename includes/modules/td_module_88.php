<?php

class td_module_88 extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="<?php echo $this->get_module_classes();?>">

            <div class="item-details">
                <?php //echo $this->get_title();?>
                <h3 class="entry-title  td-module-title">
                    <?php echo get_the_title(); ?>
                </h3>
            </div>

            <?php echo $this->get_quotes_on_blocks();?>

        </div>

        <?php return ob_get_clean();
    }
}
