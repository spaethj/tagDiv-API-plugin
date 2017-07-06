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
        td_api_block::update('td_block_related_posts',
            array(
                'map_in_visual_composer' => false,
                'file' => $this->plugin_path . '/includes/shortcodes/td_block_related_posts.php',
            )
        );
    }

}
new td_api_plugin();