<?php
/*
 * Plugin Name: td-api-plugin
 * Plugin URI: http://tagdiv.com
 * Description: tagDiv API plugin - flotauto version
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
        // Template for 'taxonomy-type-darticle-le-flash.php'
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

	    // Calaméo slider
	    td_api_block::add('td_block_calameo_slide',
		    array(
			    'map_in_visual_composer' => true,
			    "name" => 'Calaméo Slide',
			    "base" => "td_block_calameo_slide",
			    "class" => "td_block_calameo_slide",
			    "controls" => "full",
			    "category" => 'Blocks',
			    'icon' => $this->plugin_url . '/images/panel/blocks/td-block-calameo.png',
			    'file' => $this->plugin_path . '/includes/shortcodes/td_calameo_slide.php',
			    "params" => array(
				    array(
					    "param_name" => "custom_title",
					    "type" => "textfield",
					    "value" => "",
					    "heading" => 'Block title',
					    "description" => "",
					    "holder" => "div",
					    "class" => ""
				    ),
				    array(
					    "param_name" => "api_public_key",
					    "type" => "textfield",
					    "value" => "",
					    "heading" => 'API Public key',
					    "description" => "",
					    "holder" => "div",
					    "class" => ""
				    ),
				    array(
					    "param_name" => "api_secret_key",
					    "type" => "textfield",
					    "value" => "",
					    "heading" => 'API Secret key',
					    "description" => "",
					    "holder" => "div",
					    "class" => ""
				    )
			    )
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
                        'group' => 'Design options',
                    )
                )
            )
        );

        // The lightway to add video from Youtube
        td_api_block::add('td_block_youtube',
            array(
                'map_in_visual_composer' => true,
                "name" => 'Youtube',
                "base" => 'td_block_youtube',
                "class" => 'td_block_youtube',
                "controls" => "full",
                "category" => 'Blocks',
                'icon' => $this->plugin_url . '/images/panel/blocks/td-block-youtube.png',
                'file' => $this->plugin_path . '/includes/shortcodes/td_block_youtube.php',
                "params" => array(
                    array(
                        "param_name" => "custom_title",
                        "type" => "textfield",
                        "value" => "",
                        "heading" => 'Block title',
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    ),
                    array(
                        "param_name" => "yt_video_link",
                        "type" => "textfield",
                        "value" => "",
                        "heading" => 'Youtube video link',
                        "description" => "",
                        "holder" => "div",
                        "class" => ""
                    )
                )
            )
        );

        // Template for 'taxonomy-n_magazine.php'
        td_api_module::update('td_module_8',
            array(
                'file' => $this->plugin_path . '/includes/modules/td_module_8.php',
                'text' => 'Module 8',
                'img' => '',
                'used_on_blocks' => array('td_block_9', 'td_block_17'),
                'excerpt_title' => '',
                'excerpt_content' => '',
                'enabled_on_more_articles_box' => true,
                'enabled_on_loop' => true,
                'uses_columns' => true,
                'category_label' => true,
                'class' => 'td_module_wrap'
            )
        );

        // Update 'Module MX7' to show only the 255 first characters of the excerpt.
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

        // Add link on title block through 'Title Link' field.
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
						    "value" => "",
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

	    // Fork of td_module_3. Just don't display meta info.
	    td_api_module::add('td_module_33',
		    array(
			    'file' => $this->plugin_path . '/includes/modules/td_module_33.php',
			    'text' => 'Module 33',
			    'img' => $this->plugin_url . '/images/panel/modules/td_module_33.png',
			    'used_on_blocks' => array('td_module_33'),
			    'excerpt_title' => 12,
			    'excerpt_content' => '',
			    'enabled_on_more_articles_box' => true,
			    'enabled_on_loops' => true,
			    'uses_columns' => true,
			    'category_label' => true,
			    'class' => 'td_module_wrap td-animation-stack',
		    )
	    );
    }

}
new td_api_plugin();