<?php

function shortcode_news($atts) {
  function get_news_markup($news) {
    ob_start();

    foreach($news as $item) {
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
    'post_type' => 'news',
    'posts_per_page' => -1
  ];

  $news = get_posts(array_merge($atts_defaults, $atts));

  return '<ul class="news-list">' . get_news_markup($news) . '</ul>';
}

add_shortcode('news', 'shortcode_news');

?>
