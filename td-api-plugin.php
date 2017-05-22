<?php
/*
 * Plugin Name: tagDiv API plugin
 * Plugin URI: http://tagdiv.com
 * Description: tagDiv API plugin allow you to modify, add and delete elements in tagDiv Newspaper theme.
 * Author: Jeremy SPAETH
 * Version 1.0
 */

class td_api_plugin {
    var $plugin_url = '';
    var $plugin_path = '';

    function __construct()
    {
        $this->plugin_url = plugins_url('', __FILE__);
        $this->plugin_path = dirname(__FILE__);

        add_action('td_global_after', array($this, 'hook_td_global_after'));
    }

    // register new category module
    function hook_td_global_after()
    {
        td_api_module::add('td_module_110',
            array(
                'file' => $this->plugin_path . '/includes/modules/td_module_110.php',
                'text' => 'Module 110',
                'img' => $this->plugin_url . '/images/panel/modules/td_module_110.png',
                'used_on_blocks' => array('td_block_11', 'td_block_18'),
                'excerpt_title' => '',
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => false,
                'category_label' => true,
                'class' => 'td_module_10 td_module_wrap td-animation-stack',
                'group' => ''
            )
        );

        // register new single template
        td_api_single_template::add('single_template_301',
            array(
                'file' => $this->plugin_path . '/single_template_301.php',
                'text' => 'Single template 301',
                'img' => $this->plugin_url . '/images/panel/single_templates/single_template_301.png',
                'show_featured_image_on_all_pages' => false,
                'bg_disable_background' => false,
                'bg_box_layout_config' => 'auto',
                'bg_use_featured_image_as_background' => false
            )
        );

        // register update category module_mx7
        td_api_module::update('td_module_mx7',
            array(
                'file' => $this->plugin_path . '/includes/modules/td_module_mx7.php',
                'text' => 'Module MX7',
                'img' => '',
                'used_on_blocks' => array('td_block_16', 'td_block_17'),
                'excerpt_title' => '',
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loop' => true,
                'uses_columns' => true,
                'category_label' => false,
                'class' => 'td_module_wrap td-animation-stack'
            )
        );
    }

}
new td_api_plugin();
