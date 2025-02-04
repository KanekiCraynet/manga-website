<?php

// Post Type Komik
function komik() {

    $labels = array(
        'name'                => _x( 'Komik', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Komik', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Komik List', 'text_domain' ),
        'name_admin_bar'      => __( 'Komik', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Komik :', 'text_domain' ),
        'all_items'           => __( 'All Komik', 'text_domain' ),
        'add_new_item'        => __( 'Add New Komik', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'new_item'            => __( 'New Komik', 'text_domain' ),
        'edit_item'           => __( 'Edit Komik', 'text_domain' ),
        'update_item'         => __( 'Update Komik', 'text_domain' ),
        'view_item'           => __( 'View Komik', 'text_domain' ),
        'search_items'        => __( 'Search Komik', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'Komik', 'text_domain' ),
        'description'         => __( 'Komik', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', ),
        'taxonomies'          => array( 'category' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-book-alt',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'show_in_rest'        => true,
        'can_export'          => true,
        'has_archive'         => true,      
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'komik', $args );

}

add_action( 'init', 'komik', 0 );

// Post Type Chapter
function chapter() {

    $labels = array(
        'name'                => _x( 'Chapter', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Chapter', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Chapter', 'text_domain' ),
        'name_admin_bar'      => __( 'Chapter', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Chapter :', 'text_domain' ),
        'all_items'           => __( 'All Chapter', 'text_domain' ),
        'add_new_item'        => __( 'Add New Chapter', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'new_item'            => __( 'New Chapter', 'text_domain' ),
        'edit_item'           => __( 'Edit Chapter', 'text_domain' ),
        'update_item'         => __( 'Update Chapter', 'text_domain' ),
        'view_item'           => __( 'View Chapter', 'text_domain' ),
        'search_items'        => __( 'Search Chapter', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'Chapter', 'text_domain' ),
        'description'         => __( 'Chapter', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', ),
        'taxonomies'          => array( 'category' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-book-alt',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,      
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'chapter', $args );

}

add_action( 'init', 'chapter', 0 );

add_action('init', 'cptui_register_my_taxes_genres');
function cptui_register_my_taxes_genres() {
register_taxonomy( 'genres',array (
  0 => 'komik',
),
array( 'hierarchical' => false,
  'label' => 'Genres',
  'show_ui' => true,
  'query_var' => true,
  'show_admin_column' => false,
  'labels' => array (
  'search_items' => 'Genre',
  'popular_items' => 'Popular Genre',
  'all_items' => 'All Genres',
  'parent_item' => 'Parent Genre',
  'parent_item_colon' => 'Parent Genre:',
  'edit_item' => 'Edit Genre',
  'update_item' => 'Update Genre',
  'add_new_item' => 'Add New Genre',
  'new_item_name' => 'New Genre Name',
  'separate_items_with_commas' => '',
  'add_or_remove_items' => '',
  'choose_from_most_used' => '',
)
) ); 
}

add_action('init', 'cptui_register_my_taxes_type');
function cptui_register_my_taxes_type() {
register_taxonomy( 'type',array (
  0 => 'komik',
),
array( 'hierarchical' => false,
  'label' => 'Type',
  'show_ui' => true,
  'query_var' => true,
  'show_admin_column' => false,
  'labels' => array (
  'search_items' => 'Type',
  'popular_items' => 'Popular Type',
  'all_items' => 'All Genres',
  'parent_item' => 'Parent Type',
  'parent_item_colon' => 'Parent Type:',
  'edit_item' => 'Edit Type',
  'update_item' => 'Update Type',
  'add_new_item' => 'Add New Type',
  'new_item_name' => 'New Type Name',
  'separate_items_with_commas' => '',
  'add_or_remove_items' => '',
  'choose_from_most_used' => '',
)
) ); 
}