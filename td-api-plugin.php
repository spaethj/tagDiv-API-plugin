<?php
/*
 * Plugin Name: td-api-plugin
 * Plugin URI: http://tagdiv.com
 * Description: tagDiv API plugin
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

        td_api_block::update('td_block_trending_now',
            array(
                'map_in_visual_composer' => true,
                "name" => 'News ticker',
                "base" => 'td_block_trending_now',
                "class" => 'td_block_trending_now',
                "controls" => "full",
                "category" => 'Blocks',
                'icon' => 'icon-pagebuilder-td_block_trending_now',
                'file' => $this->plugin_path . '/includes/shortcodes/td_block_trending_now.php',
                "params" => array_merge(
                    td_config::get_map_filter_array(),
                    array(
                        array (
                            'param_name' => 'css',
                            'value' => '',
                            'type' => 'css_editor',
                            'heading' => 'Css',
                            'group' => 'Design options',
                        ),
                        array(
                            "param_name" => "title_link",
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'Title Link:',
                            "description" => "Optional - Add link on title block. (e.g: /slug/taxonomy)",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "navigation",
                            "type" => "dropdown",
                            "value" => array('Auto' => '', 'Manual' => 'manual'),
                            "heading" => 'Navigation:',
                            "description" => "If set on `Auto` will set the `Trending Now` block to auto start rotating posts",
                            "holder" => "div",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "style",
                            "type" => "dropdown",
                            "value" => array('Default' => '', 'Style 2' => 'style2'),
                            "heading" => 'Style:',
                            "description" => "Style of the `Trending Now` box",
                            "holder" => "div",
                            "class" => ""
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title text color',
                            "param_name" => "header_text_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom title text color for this block'
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title background color',
                            "param_name" => "header_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom title background color for this block'
                        )

                    )
                ),
            )
        );

        td_api_module::update('td_module_trending_now',
            array(
                'file' => $this->plugin_path . '/includes/modules/td_module_trending_now.php',
                'text' => 'Trending now module',
                'img' => '',
                'used_on_blocks' => '',
                'excerpt_title' => 25,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => false,
                'enabled_on_loops' => false,
                'uses_columns' => false,
                'category_label' => false,
                'class' => '',
            )
        );
    }

}
new td_api_plugin();