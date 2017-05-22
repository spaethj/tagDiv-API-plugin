<?php
// Template 301

$categories = get_the_category();

if ( ! empty( $categories ) ) {
    header('Location: ' . bloginfo('url') . '/'. esc_html( $categories[0]->slug) .'/#' . get_the_ID());
}
