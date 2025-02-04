<?php

function get_page_url($page)
{
    if (!$page) {
        return get_bloginfo('siteurl');
    }

    $data = get_posts([
        'post_type'  => 'page',
        'meta_key'   => '_wp_page_template',
        'meta_value' => 'pages/' . $page . '.php',
    ]);

    if (empty($data)) {
        return get_bloginfo('siteurl');
    }

    return get_page_link($data[0]->ID);
}
