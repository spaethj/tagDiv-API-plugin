<?php
/*
 * Plugin Name: td-api-plugin
 * Plugin URI: http://tagdiv.com
 * Description: tagDiv API plugin - Voyages d'Affaires version.
 * Author: Jeremy SPAETH
 * Version 1.0
 */

// register new category module
class td_api_plugin {
    var $plugin_url = '';
    var $plugin_path = '';

    function __construct()
    {
        $this->plugin_url = plugins_url('', __FILE__);
        $this->plugin_path = dirname(__FILE__);

        add_action('td_global_after', array($this, 'hook_td_global_after'));
    }

    function hook_td_global_after()
    {

        // Sort by date (default: random) related posts in more articles box.
        td_api_module::update('td_module_6',
            array(
                'file' => $this->plugin_path . '/includes/modules/td_module_6.php',
                'text' => 'Module 6',
                'img' => $this->plugin_url . '/images/panel/modules/td_module_6.png',
                'used_on_blocks' => '',
                'excerpt_title' => 12,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,
                'category_label' => true,
                'class' => 'td_module_6 td_module_wrap td-animation-stack',
            )
        );

        // Delete related more from author at the botom of all posts.
        td_api_block::update('td_block_related_posts',
            array(
                'map_in_visual_composer' => false,
                'file' => $this->plugin_path . '/includes/shortcodes/td_block_related_posts.php',
            )
        );
    }

}
new td_api_plugin();