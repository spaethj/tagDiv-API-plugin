<?php

class td_module_6 extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="<?php echo $this->get_module_classes();?>" <?php echo $this->get_item_scope();?>>

            <?php echo $this->get_image('td_100x70');?>

            <div class="item-details">
                <?php echo $this->get_title();?>
                <div class="td-module-meta-info">
                    <?php if (td_util::get_option('tds_category_module_6') == 'yes') { echo $this->get_category(); }?>
                </div>
            </div>
            <?php echo $this->get_item_scope_meta();?>
        </div>

        <?php return ob_get_clean();
    }
}