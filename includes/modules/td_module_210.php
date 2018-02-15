<?php

class td_module_210 extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="<?php echo $this->get_module_classes();?>">
            <?php echo $this->get_image('td_218x150');?>

            <div class="item-details">
                <?php echo $this->get_title();?>

                <?php if (is_front_page()): ?>
                    <div class="td-excerpt">
                        <?php echo $this->get_excerpt();?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <?php return ob_get_clean();
    }

}