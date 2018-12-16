<?php

function create_demands_posttype() {
  register_post_type('demands',
    array(
      'labels' => array(
        'name' => pll__('Demands'),
        'singular_name' => pll__('Demand')
        ),
        'public' => true,
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

add_action('init', 'create_demands_posttype');

?>