<?php

class td_rss_feed_to_slider extends td_block {

	function url_valid(&$url) {
		$file_headers = @get_headers($url);

		// if server not found
		if ($file_headers === false) {
			return false;
		}

		// parse all headers
		foreach($file_headers as $header) {
			// corrects $url when 301/302 redirect(s) lead(s) to 200:
			if(preg_match("/^Location: (http.+)$/",$header,$m)) $url=$m[1];

			// grabs the last $header $code, in case of redirect(s):
			if(preg_match("/^HTTP.+\s(\d\d\d)\s/",$header,$m)) $code=$m[1];
		}

		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed($url);

		// $code 200 == all OK
		if($code == 200 && !is_wp_error($rss)) {
			return $rss;
		}
		else {
			// return error message in error.log file.
			error_log('RSS feed to slider block: The entered URL is not valid an return HTTP header code' . $code);
		}
	}

	function rss_link_field($atts)
	{
		$rss_link = '';

		if (!empty($atts['rss_link'])) {
			$esc_url = esc_url($atts['rss_link']);

			if (!empty($this->url_valid($esc_url))) {

				// Figure out how many total items there are, but limit it to 5.
				$maxitems = $this->url_valid($esc_url)->get_item_quantity(5);

				// Build an array of all the items, starting with element 0 (first element).
				$rss_items = $this->url_valid($esc_url)->get_items(0, $maxitems);

				$rss_link .= '<ul class="td-slider">';
			    foreach ($rss_items as $item) {
				    $rss_link .= '<li>';
                    $rss_link .= '<a href="' . esc_url($item->get_permalink()) . '" title="' . esc_html($item->get_title()) . '" target="_blank">';
                    $rss_link .= esc_html( $item->get_title());
                    $rss_link .= '</a>';
                    $rss_link .= '</li>';
				}
				$rss_link .= '</ul>';
			}
		}

		return $rss_link;
	}

	function custom_title_field($atts)
	{
		$custom_title = '';

		if (!empty(['custom_title'])) {
			$custom_title = '<h3>' . esc_html($atts['custom_title']) . '</h3>';
		}

		return $custom_title;
	}

	function image_field($atts)
	{
		$image = '';

		if (!empty($atts['image'])) {
			$image = $atts['image'];

			$image_id = wp_get_attachment_image_src( $image, 'full' );
			$image_path = $image_id[0];

			$image = '<img src="' . $image_path . '" />';
		}

		return $image;
	}

	function txt_img_link($atts)
	{
		$a_opening_tag = '';
		$a_closing_tag = '';

		if ($atts['txt_img_link'] !== '|||') {
			$txt_img_link = $atts['txt_img_link'];

			// convert $txt_img_link in array
			$til_array = vc_build_link($txt_img_link);

			// remove first item in array
			$rm_first = array_slice($til_array, 1);

			// remove empty values
			$rm_empty = array_filter($rm_first);

			$a_opening_tag .= '<a href="' . $til_array['url'] . '" ';

			foreach ($rm_empty as $key => $item) {
				$a_opening_tag .= $key . '="' . $item . '" ';
			}

			$a_opening_tag .= '>';

			$a_closing_tag .= '</a>';
		}

		return $a_opening_tag . $this->custom_title_field($atts) . $this->image_field($atts) . $a_closing_tag;
	}

	function render($atts, $content = null) {
		parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

		$buffy = '';

		$buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

		$buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
		$buffy .= $this->inner($atts);
		$buffy .= '</div>';

		$buffy .= '</div> <!-- ./block -->';
		return $buffy;
	}

	function inner($atts, $is_ajax = false) {

		$buffy = '';

		$td_unique_id_slide = td_global::td_generate_unique_id();

		//@generic class for sliders : td-theme-slider
		$buffy .= '<div id="' . $td_unique_id_slide . '" class="td-theme-slider iosSlider-col-1 td_mod_wrap">';
		$buffy .= $this->rss_link_field($atts);
		$buffy .= '<i class = "td-icon-left prevButton"></i>';
		$buffy .= '<i class = "td-icon-right nextButton"></i>';
		$buffy .= '</div>'; //close ios

		$buffy .= $this->txt_img_link($atts);

		// Suppress any iosSlider in tagDiv composer
		if (td_util::tdc_is_live_editor_iframe() or td_util::tdc_is_live_editor_ajax()) {
			return $buffy;
		}





		$slide_js = '
jQuery(document).ready(function() {
    jQuery("#' . $td_unique_id_slide . '").iosSlider({
        snapToChildren: true,
        desktopClickDrag: true,
        keyboardControls: false,
        responsiveSlideContainer: true,
        responsiveSlides: true,
        autoSlide: true,
        autoSlideTimer: 3000,

        infiniteSlider: true,
        navPrevSelector: jQuery("#' . $td_unique_id_slide . ' .prevButton"),
        navNextSelector: jQuery("#' . $td_unique_id_slide . ' .nextButton")

    });
});
    ';

		if ($is_ajax) {
			$buffy .= '<script>' . $slide_js . '</script>';
		} else {
			td_js_buffer::add_to_footer($slide_js);
		}

		return $buffy;
	}
}