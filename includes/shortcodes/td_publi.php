<?php
class td_publi extends td_block
{
    function render($atts, $content = null)
    {
        parent::render($atts);

        $buffy = ''; //output buffer

        //get the js for this block
        $buffy .= $this->get_block_js();

        $buffy .= '<div class="' . $this->get_block_classes() . '">';

        //get the block title
        $buffy .= $this->publi_title($atts);

        //get the sub category filter for this block
        $buffy .= $this->get_pull_down_filter();

        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
        $buffy .= $this->inner($this->td_query->posts); //inner content of the block
        $buffy .= '</div>';
        $buffy .= '</div>';

        return $buffy;
    }

    function publi_title($atts)
    {
        $buffy = '';

        if (isset($atts['title'])) {
            $custom_title = $atts['title'];

            $buffy .= '<div class="bloc-publi-title">';
            $buffy .= '<hr />';
            $buffy .= '<h3>' . $custom_title . '</h3>';
            $buffy .= '</div>'; // bloc-publi-title
        }
        return $buffy;
    }

    function inner($posts, $td_column_number = '')
    {
        $buffy = '';
        $td_block_layout = new td_block_layout();

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $td_module_210 = new td_module_210($post);

                $buffy .= $td_block_layout->open12();
                $buffy .= $td_module_210->render($post);
                $buffy .= $td_block_layout->close12();
            }
        }
        $buffy .= $td_block_layout->close_all_tags();
        return $buffy;
    }
}
