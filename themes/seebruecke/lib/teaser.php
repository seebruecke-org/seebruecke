<?php

function shortcode_teaser($atts) {
  $atts = array_change_key_case((array)$atts, CASE_LOWER);
  $atts_defaults = [
    'title' => false,
    'description' => false,
    'cta_label' => false,
    'cta_target' => false,
    'image_id' => false,
    'reverse' => false
  ];

  $atts = array_merge($atts_defaults, $atts);

  $title = "<h2 class=\"v2-teaser__title\">{$atts['title']}</h2>";
  $description = "<p class=\"v2-teaser__description\">{$atts['description']}</p>";
  $cta = "<a href='{$atts['cta_target']}' class=\"v2-button\">{$atts['cta_label']}</a>";
  $css_classes = '';

  if ($atts['reverse'] === 'true') {
    $css_classes .= ' v2-teaser--reverse';
  }

  return "<div class=\"v2-teaser {$css_classes}\">" .
    '<div class="v2-teaser__content-container">' .
      $title .
      $description .
      $cta .
    '</div>' .

    '<figure class="v2-teaser__image-container">' .
      wp_get_attachment_image($atts['image_id'], 'teaser', false, [
        'loading' => 'lazy',
        'class' => 'v2-teaser__image'
      ]) .
    '</figure>' .
  '</div>';
}

add_shortcode('teaser', 'shortcode_teaser');

?>
