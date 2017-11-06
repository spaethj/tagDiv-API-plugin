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

        // Add new block in Visual Composer, to shown images registered in 'Thumbnail image' field (view 'n_magazine' taxonomy).
        td_api_block::add('td_block_thumbnail_taxonomy',
            array(
                'map_in_visual_composer' => true,
                "name" => 'Thumbnail Taxonomy',
                "base" => 'td_block_thumbnail_taxonomy',
                "class" => 'td_block_thumbnail_taxonomy',
                "controls" => "full",
                "category" => 'Blocks',
                'icon' => $this->plugin_url . '/images/panel/blocks/block-thumbnail-taxonomy.png',
                'file' => $this->plugin_path . '/includes/shortcodes/td_block_thumbnail_taxonomy.php',
                "params" => array(
                    array(
                        "param_name" => "custom_title",
                        "type" => "textfield",
                        "value" => "",
                        "heading" => 'Optional - custom title for this block:',
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "limit",
                        "type" => "textfield",
                        "value" => "0",
                        "heading" => 'Limit the number of cover shown:',
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "offset",
                        "type" => "textfield",
                        "value" => "0",
                        "heading" => 'Offset cover',
                        "description" => 'Start the count with an offset.',
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "name__like",
                        "type" => "textfield",
                        "value" => "",
                        "heading" => 'Filter by terms name:',
                        "description" => "Type common string about all terms name you want shown. (e.g. To filter by Monthly magazine, type 'n°')",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "column",
                        "type" => "dropdown",
                        "value" => array('One' => 'one', 'Two' => 'two', 'Three' => 'three', 'Four' => 'four'),
                        "heading" => 'Column(s)',
                        "description" => "Shown your covers on one, two, three or four columns",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array (
                        'param_name' => 'css',
                        'value' => '',
                        'type' => 'css_editor',
                        'heading' => 'Css',
                        'group' => 'Design options'
                    )
                )
            )
        );

        // Add new block in Visual Composer to shown "Publi-Communiqués" in the home page and the sidebars
        td_api_block::add('td_publi',
            array(
                'map_in_visual_composer' => true,
                'name' => 'Block Publi-Commnuniqué',
                'base' => 'td_publi',
                'class' => 'td_publi',
                'control' => 'full',
                "category" => 'Blocks',
                'icon' => $this->plugin_url . '/images/panel/blocks/block-publi.png',
                'file' => $this->plugin_path . '/includes/shortcodes/td_publi.php',
                "params" => array_merge(
                    array(
                        array(
                            "param_name" => "title",
                            "type" => "textfield",
                            "value" => "Block title",
                            "heading" => 'Custom title for this block:',
                            "description" => "Optional - a title for this block, if you leave it blank the block will not have a title",
                            "holder" => "div",
                            "class" => ""
                        )
                    ),
                    td_config::get_map_filter_array()
                )
            )
        );

        // Fork of td_module_10. Displays the title, thumbnail and excerpt in "td_publi" block.
        td_api_module::add('td_module_210',
            array(
                'file' => $this->plugin_path . '/includes/modules/td_module_210.php',
                'text' => 'Module 210',
                'img' => $this->plugin_url . '/images/panel/modules/td_module_210.png',
                'used_on_blocks' => array('td_publi'),
                'excerpt_title' => 12,
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loops' => true,
                'uses_columns' => true,
                'category_label' => true,
                'class' => 'td_module_10 td_module_wrap td-animation-stack',
            )
        );
    }

}
new td_api_plugin();