<?php

function get_all_events() {
  return new WP_Query(
    array(
      'post_type' => 'events',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    )
  );
}

function get_latest_header() {
  return new WP_Query(
    array(
      'post_type' => 'headers',
      'post_status' => 'publish',
      'posts_per_page' => 1,
    )
  );
}

function create_posttypes() {
  register_post_type('headers',
    array(
      'labels' => array(
        'name' => pll__('Headers'),
        'singular_name' => pll__('Header')
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array(
          'title',
          'thumbnail',
          'revisions',
        )
    )
  );

  register_post_type('events',
    array(
      'labels' => array(
        'name' => pll__('Events'),
        'singular_name' => pll__('Event')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'events'),
        'supports' => array(
          'title',
          'editor',
          'thumbnail',
          'revisions',
        )
    )
  );
}

function register_meta_boxes($meta_boxes) {
  // Header
  $meta_boxes[] = array(
    'id'         => 'header_data',
    'title'      => 'Extended information',
    'post_types' => 'headers',
    'context'    => 'normal',
    'priority'   => 'high',
    'fields'     => array(
      array(
        'name'  => 'Action text',
        'desc'  => '(Label of the button)',
        'id'    => 'header_label',
        'type'  => 'text',
      ),

      array(
        'name'  => 'Link',
        'desc'  => '(Link target of the button)',
        'id'    => 'header_reference',
        'type'  => 'post',
        'post_type' => 'page',
        'field_type'  => 'select_advanced',
      ),
    ),
  );

  // Events
  $meta_boxes[] = array(
    'id'         => 'data',
    'title'      => 'Extended information',
    'post_types' => 'events',
    'context'    => 'normal',
    'priority'   => 'high',
    'fields' => array(
        array(
            'name'  => 'Location',
            'desc'  => 'Name of the location',
            'id'    => 'location',
            'type'  => 'text',
        ),

        array(
          'name'  => 'Location',
          'desc'  => 'Coordinates of the location',
          'id'    => 'coordinates',
          'type'  => 'map',
          'address_field' => 'location',
      ),

        array(
          'name'  => 'Date',
          'desc'  => 'When does the event take place?',
          'id'    => 'date',
          'type'  => 'date',
        ),

        array(
          'name'  => 'Time',
          'desc'  => 'When does the event take place?',
          'id'    => 'time',
          'type'  => 'time',
        ),

        array(
          'name'  => 'Type',
          'desc'  => 'Which kind of event is it?',
          'id'    => 'type',
          'type'  => 'select',
          'options' => array(
            'demonstration' => pll__('Demonstration'),
            'action' => pll__('Action'),
            'speech' => pll__('Speech'),
          ),
          'multiple' => false,
        ),

        array(
          'name'  => 'Link',
          'desc'  => '',
          'id'    => 'link',
          'type'  => 'text',
        ),
      )
  );

  return $meta_boxes;
}

function cleanup_admin() {
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
}

function remove_wp_version() {
  return '';
}

add_action('init', 'create_posttypes');
add_filter('rwmb_meta_boxes', 'register_meta_boxes');

add_theme_support('post-thumbnails');

add_filter('the_generator', 'remove_wp_version');
add_action('admin_menu','cleanup_admin');

?>
