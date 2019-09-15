<?php

function shortcode_news($atts) {
  function get_news_markup($posts) {
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
  $atts['count'] = 5;

  $news = get_posts([
    'numberposts' => $atts['count'],
    'post_type' => 'news'
  ]);

  return '<ul class="news-list">' . get_news_markup($news) . '</ul>';
}

add_shortcode('news', 'shortcode_news');

?>
