<?php

function shortcode_pressreleases($atts) {
  function get_pressrelease_markup($posts) {
    ob_start();

    foreach($posts as $item) {
      get_component('news/item', [
        'post' => $item->to_array()
      ]);
    }

    $markup = ob_get_contents();
    ob_end_clean();

    return $markup;
  }

  $atts = array_change_key_case((array)$atts, CASE_LOWER);
  $atts_defaults = [
    'count' => -1
  ];

  $atts = array_merge($atts_defaults, $atts);

  $pressreleases = get_posts([
    'numberposts' => $atts['count'],
    'post_type' => 'pressrelease'
  ]);

  return '<ul class="news-list">' . get_pressrelease_markup($pressreleases) . '</ul>';
}

function pressrelease_register_post_type() {
  register_post_type('pressrelease',
    array(
      'labels' => array(
        'name' => 'Press',
        'singular_name' => 'Press'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-id',
        'has_archive' => false,
        'rewrite' => array(
          'slug' => 'press'
        ),
        'show_in_rest' => true,
        'supports' => array(
          'author',
          'title',
          'editor',
          'excerpt',
          'thumbnail',
          'revisions',
        )
    )
  );
}

add_action('init', 'pressrelease_register_post_type');
add_shortcode('pressreleases', 'shortcode_pressreleases');

?>
