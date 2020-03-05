<?php

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

function shortcode_news($atts) {
  $atts = array_change_key_case((array)$atts, CASE_LOWER);
  $atts_defaults = [
    'post_type' => 'news',
    'posts_per_page' => -1
  ];

  $news = get_posts(array_merge($atts_defaults, $atts));

  return '<ul class="news-list">' . get_news_markup($news) . '</ul>';
}

function news_register_post_type() {
  register_post_type('news',
    array(
      'labels' => array(
        'name' => 'News',
        'singular_name' => 'News'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-id',
        'has_archive' => false,
        'rewrite' => array(
          'slug' => 'news'
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

add_action('init', 'news_register_post_type');
add_shortcode('news', 'shortcode_news');

?>
