<?php

class td_block_youtube extends td_block {

    function __construct() {
        parent::disable_loop_block_features();
        add_action('wp_footer', array($this, 'td_block_youtube'));
    }

    function td_block_youtube()
    {
        wp_register_script('td_block_youtube', plugins_url('../javascripts/td_block_youtube.js', dirname(__FILE__)));
        wp_enqueue_script('td_block_youtube');
    }

    function video_id($atts)
    {
        $buffy = '';
        $yt_video_link = '';
        if (!empty($atts['yt_video_link'])) {
            $yt_video_link = $atts['yt_video_link'];
        }

        $buffy .= str_replace('https://www.youtube.com/watch?v=', '', $yt_video_link);
        return $buffy;
    }

    function render($atts, $content = null) {
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        $buffy = '';

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';
        //get the block title
        $buffy .= $this->get_block_title();

        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
        $buffy .= $this->inner($atts);
        $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($atts) {

        $buffy = '';

        $buffy .= '<div class="youtube-player" data-id="' . $this->video_id($atts) . '"></div>';


        return $buffy;
    }
}