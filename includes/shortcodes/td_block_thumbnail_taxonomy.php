<?php

class td_block_thumbnail_taxonomy extends td_block
{

    function thumbnail_image_isset($term_ids, $term_names)
    {
        $buffy = '';

        if (function_exists('get_thumbnail_image')) {
            $buffy .= '<img src="' . get_thumbnail_image($term_ids) . '" alt="' . get_bloginfo('name') . ' ' .$term_names . '" title="Magazine ' . $term_names . '" />';
        }
        return $buffy;
    }

    function render($atts, $content = null)
    {
        parent::render($atts);

        $buffy = '';

        foreach ($atts as $att => $value) {
            if (empty($value)) {
                echo '';
            }
        }
        
        $limit = $atts['limit'];
        $offset = $atts['offset'];
        $name__like = $atts['name__like'];
        $column = $atts['column'];

        $args = array(
            'taxonomy' => 'n_magazine',
            'number' => $limit,
            'offset' => $offset,
            'name__like' => $name__like
        );

        $terms = get_terms($args);

        $buffy .= '<div class="' . $this->get_block_classes(array('widget', 'widget_categories')) . '">';


        $buffy .= $this->get_block_title();

        if (!empty($terms)) {
            if (!is_wp_error($terms)) {
                foreach ($terms as $term){
                        $buffy .= '<a class="col_' . $column . '" href="' . esc_url( get_term_link( $term ) ) . '" title="' . esc_html($term->name) . '">';
                        $buffy .= '<h2>' . esc_html($term->name) . '</h2>';
                        $buffy .= $this->thumbnail_image_isset($term->term_id, $term->name);
                        $buffy .= '</a>';
                }
            }
        }

        $buffy .= '</div> <!-- ./block -->';

        return $buffy;
    }

    function inner($posts, $td_column_number = '')
    {

    }
}
