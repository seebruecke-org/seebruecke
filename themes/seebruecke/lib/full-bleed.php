<?php

function shortcode_full_bleed($atts) {
  $atts = array_change_key_case((array)$atts, CASE_LOWER);
  $atts_defaults = [
    'title' => false,
    'description' => false,
    'cta_label' => false,
    'cta_target' => false,
  ];

  $atts = array_merge($atts_defaults, $atts);
  $button_icon = "<svg aria-hidden=\"true\" focusable=\"false\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 320 512\"><path fill=\"currentColor\" d=\"M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z\"></path></svg>";

  return "<div class=\"v2-full-bleed\">" .
    "<div class=\"v2-full-bleed__inner\">" .
      "<div class=\"v2-full-bleed__content-container\">" .
        "<h2 class=\"v2-full-bleed__title\">{$atts['title']}</h2>" .
        "<p class=\"v2-full-bleed__description\">{$atts['description']}</p>" .
      "</div>" .

      "<div class=\"v2-full-bleed__cta-container\">" .
        "<a href=\"{$atts['cta_target']}\" class=\"v2-button v2-button--secondary v2-button--dense\">" .
          $atts['cta_label'] .
          $button_icon .
        "</a>" .
      "</div>" .
    "</div>" .
  "</div>";
}

add_shortcode('full-bleed', 'shortcode_full_bleed');

?>
