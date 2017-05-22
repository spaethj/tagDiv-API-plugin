<?php
class td_module_110 extends td_module {
    function __construct($post)
    {
        //run the parrent constructor
        parent::__construct($post);
    }

    function get_secondary_categories() {

        $categories = array_slice(get_the_category(), 1);

        if ( ! empty( $categories ) ) {
            foreach ($categories as $category){
                echo '<a href="'. esc_url(get_category_link($category->term_id)) .'" class="td-post-category">' . esc_html($category->name) . '</a>';
            }
        }
    }

    function render()
    {
        ob_start();
        ?>
        <div id="<?php echo get_the_ID(); ?>" class="<?php echo $this->get_module_classes();?>">
            <div class="item-details">

                <div class="td-module-meta-info">
                    <?php echo $this->get_date();?>
                    <?php echo $this->get_secondary_categories(); ?>
                </div>
                    <div class="border_solid">
                    <h2 class="entry-title  td-module-title">
                        <?php echo get_the_title(); ?>
                    </h2>
                    <?php echo get_the_post_thumbnail(); ?>
                    <div class="td-excerpt">
                        <?php echo $this->get_excerpt();?>
                    </div>
                </div>
            </div>

        </div>

        <?php return ob_get_clean();
    }

}
