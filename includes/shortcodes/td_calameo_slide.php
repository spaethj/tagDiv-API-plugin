<?php

class td_block_calameo_slide extends td_block {

    // Check if API public key and API secret key fields are filled
    function api_fields_isset($atts) {

        $params = '';

        if (!empty($atts['api_public_key'] && $atts['api_secret_key'])) {
            $public_key = $atts['api_public_key'];
            $secret_key = $atts['api_secret_key'];

            $params = array(
                '' => $secret_key, // the API secret key
                'actionAPI' => '.fetchSubscriptionBooks',
                'apikey' => $public_key,
                'output' => 'JSON',
                'step' => '50',
                'subscription_id' => '970896',
                'way' => 'DOWN'
            );
        };
        return $params;
    }

    // Generate md5 sign
    function md5_sign($atts) {

        $api_fields = $this->api_fields_isset($atts);

        $sign = '';
        foreach ($api_fields as $key => $api_field) {
            $sign .= $key . $api_field;
        }
        $md5 = md5($sign);

        return $md5;
    }

    // The complete request to get JSON array
    function api_to_json($atts) {

        $api_fields = $this->api_fields_isset($atts);
        $md5_sign = $this->md5_sign($atts);

        $keys = array_keys($api_fields);

        $json = 'http://api.calameo.com/1.0?';
        $json .= $keys[2] . '=' . $api_fields['apikey'];
        $json .= '&action=API' . $api_fields['actionAPI'];
        $json .= '&' . $keys[3] . '=' . $api_fields['output'];
        $json .= '&signature=' . $md5_sign;
        $json .= '&' . $keys[5] . '=' . $api_fields['subscription_id'];
        $json .= '&' . $keys[6] . '=' .$api_fields['way'];
        $json .= '&' . $keys[4] . '=' .$api_fields['step'];

        return $json;
    }

    function render($atts, $content = null){
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        $buffy = ''; //output buffer

        if (strlen($this->api_to_json($atts)) == 195) {

            $json = $this->api_to_json($atts);
            $objs = json_decode(file_get_contents($json));
            $items = $objs->response->content->items;

            $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

            //get the block js
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();

            if (!empty ($this->get_block_title())) {
                $buffy .= $this->get_block_title();
            }

            $buffy .= $this->get_pull_down_filter();
            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
            $buffy .= $this->inner($items, '1');
            $buffy .= '</div>';
            $buffy .= '</div>';
        }
        return $buffy;
    }


    /**
     * @param $items
     * @param string $td_column_number - get the column number
     * @param bool $is_ajax - if true the script will return the js inline, if not, it will use the td_js_buffer class
     * @return string
     */
    function inner($items, $td_column_number = '', $is_ajax = false) {
        $buffy = '';

        $td_block_layout = new td_block_layout();
        if (empty($td_column_number)) {
            $td_column_number = td_util::vc_get_column_number(); // get the column width of the block from the page builder API
        }


        $td_unique_id_slide = td_global::td_generate_unique_id();

        //@generic class for sliders : td-theme-slider
        $buffy .= '<div id="' . $td_unique_id_slide . '" class="td-theme-slider iosSlider-col-' . $td_column_number . ' td_mod_wrap">';
        $buffy .= '<div class="td-slider">';
        if (!empty($items)) {
            foreach ($items as $item) {

                $buffy .= '<div class="td_module_slide td-animation-stack">';
                $buffy .= '<div class="td-module-thumb">';
                $buffy .= '<a href="' . $item->ViewUrl . '" rel="bookmark" title="' . $item->Name . '" target="_blank">';
                $buffy .= '<img class="entry-thumb td-animation-stack-type0-2" src="' . $item->PosterUrl . '" alt="' . $item->Name . '" />';
                $buffy .= '</a>';
                $buffy .= '</div>'; // close td-module-thumb
                $buffy .= '</div>'; // close td_module_slide

                // Show only the first frame in tagDiv composer
                if (td_util::tdc_is_live_editor_iframe() or td_util::tdc_is_live_editor_ajax()) {
                    break;
                }
            }
        }
        //$buffy .= $td_block_layout->close_all_tags();
        $buffy .= '</div>'; // close td-slider

        $buffy .= '<i class = "td-icon-left prevButton"></i>';
        $buffy .= '<i class = "td-icon-right nextButton"></i>';

        $buffy .= '</div>'; //close ios

        // Suppress any iosSlider in tagDiv composer
        if (td_util::tdc_is_live_editor_iframe() or td_util::tdc_is_live_editor_ajax()) {
            return $buffy;
        }



        //add resize events
        //$add_js_resize = '';
        //if($td_column_number > 1) {
        $add_js_resize = ',
                //onSliderLoaded : td_resize_normal_slide,
                //onSliderResize : td_resize_normal_slide_and_update';
        //}


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
        ' . $add_js_resize . '
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
