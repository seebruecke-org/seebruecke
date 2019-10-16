<?php

function shortcode_pressreleases($atts) {
  function get_markup($posts) {
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
    'count' => 5
  ];

  $atts = array_merge($atts_defaults, $atts);

  $news = get_posts([
    'numberposts' => $atts['count'],
    'post_type' => 'pressrelease'
  ]);

  return '<ul class="news-list">' . get_markup($news) . '</ul>';
}

add_shortcode('pressreleases', 'shortcode_pressreleases');

?>
