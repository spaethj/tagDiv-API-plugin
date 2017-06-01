<?php

class td_module_110 extends td_module {
    function __construct($post)
    {
        //run the parrent constructor
        parent::__construct($post);
        add_action( 'wp_enqueue_scripts', 'my_styles_method' );
    }

    function render()
    {
        ob_start(); ?>
        <span id="<?php echo get_the_ID(); ?>" class="offset"></span>
        <div class="<?php echo $this->get_module_classes(); ?>">
            <div class="item-details">

                <div class="td-module-meta-info">
                    <?php echo $this->get_date();?>
                </div>
                    <div class="border_solid">
                    <h2 class="entry-title  td-module-title">
                        <?php echo get_the_title(); ?>
                    </h2>
                    <?php echo get_the_post_thumbnail(); ?>
                    <div class="td-content">
                        <?php echo get_the_content();?>
                    </div>
                </div>
            </div>

        </div>
        <?php return ob_get_clean();
    }
}
