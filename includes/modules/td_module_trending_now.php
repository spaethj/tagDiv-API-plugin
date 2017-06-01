<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 03.02.2015
 * Time: 10:05
 */

class td_module_trending_now extends td_module {

    var $title_link;

    function __construct($post, $title_link) {
        parent::__construct($post, $title_link);

        $this->title_link = $title_link;
    }

    function get_custom_title($cut_at = '') {
        $buffy = '';
        $buffy .= '<h3 class="entry-title td-module-title">';
        $buffy .='<a href="' . $this->title_link . '/#' . $this->post->ID . '" rel="bookmark" title="' . $this->title_attribute . '">';

        //see if we have to cut the title and if we have the title lenght in the panel for ex: td_module_6__title_excerpt
        if ($cut_at != '') {
            //cut at the hard coded size
            $buffy .= td_util::excerpt($this->title, $cut_at, 'show_shortcodes');

        } else {
            $current_module_class = get_class($this);

            //see if we have a default setting for this module, and if so only apply it if we don't get other things form theme panel.
            if (td_api_module::_helper_check_excerpt_title($current_module_class)) {
                $db_title_excerpt = td_util::get_option($current_module_class . '_title_excerpt');
                if ($db_title_excerpt != '') {
                    //cut from the database settings
                    $buffy .= td_util::excerpt($this->title, $db_title_excerpt, 'show_shortcodes');
                } else {
                    //cut at the default size
                    $module_api = td_api_module::get_by_id($current_module_class);
                    $buffy .= td_util::excerpt($this->title, $module_api['excerpt_title'], 'show_shortcodes');
                }
            } else {
                /**
                 * no $cut_at provided and no setting in td_config -> return the full title
                 * @see td_global::$modules_list
                 */
                $buffy .= $this->title;
            }

        }
        $buffy .='</a>';
        $buffy .= '</h3>';
        return $buffy;
    }

    function render($order_no) {
        ob_start();
        ?>

        <div class="<?php echo $this->get_module_classes(array("td-trending-now-post-$order_no", "td-trending-now-post")); ?>">

            <?php echo $this->get_custom_title()?>

        </div>

        <?php return ob_get_clean();
    }
}