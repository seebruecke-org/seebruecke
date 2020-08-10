<?php

function demands_register_post_type() {
  register_post_type('demands',
    array(
      'labels' => array(
        'name' => 'Demands',
        'singular_name' => 'Demand'
        ),
        'public' => true,
        'capability_type' => 'demand',
        'menu_icon' => 'dashicons-welcome-comments',
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'has_archive' => false,
        'supports' => array(
          'title',
          'editor',
          'revisions',
        )
    )
  );
}

add_action('init', 'demands_register_post_type');

?>
