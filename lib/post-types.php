<?php

//* Add custom post types
// Register Custom Post Type for DMD Events
function create_event_post_type() {

  $labels = array(
    'name'                  => 'DMD Events',
    'singular_name'         => 'DMD Event',
    'menu_name'             => 'DMD Event',
    'name_admin_bar'        => 'DMD Event',
    'archives'              => 'Item Archives',
    'parent_item_colon'     => 'Parent Item:',
    'all_items'             => 'All Events',
    'add_new_item'          => 'Add New Event',
    'add_new'               => 'Add New',
    'new_item'              => 'New Event',
    'edit_item'             => 'Edit Event',
    'update_item'           => 'Update Event',
    'view_item'             => 'View Event',
    'search_items'          => 'Search Event',
    'not_found'             => 'Not found',
    'not_found_in_trash'    => 'Not found in Trash',
    'featured_image'        => 'Featured Image',
    'set_featured_image'    => 'Set featured image',
    'remove_featured_image' => 'Remove featured image',
    'use_featured_image'    => 'Use as featured image',
    'insert_into_item'      => 'Insert into item',
    'uploaded_to_this_item' => 'Uploaded to this item',
    'items_list'            => 'Items list',
    'items_list_navigation' => 'Items list navigation',
    'filter_items_list'     => 'Filter items list',
  );
  $args = array(
    'label'                 => 'DMD Event',
    'description'           => 'DMD Events',
    'labels'                => $labels,
    'supports'              => array( 'title', ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-calendar-alt',
    'show_in_admin_bar'     => false,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => false,   
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'event_type', $args );

}
add_action( 'init', 'create_event_post_type', 0 );