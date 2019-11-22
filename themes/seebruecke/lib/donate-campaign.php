<?php

function donate_campaign_shortcode($atts = ['title' => null, 'excerpt' => null, 'twingle_identifier' => null, 'media_id' => null]) {
  $twingle = do_shortcode('[twingle_event identifier="' . $atts['twingle_identifier'] . '"]');
  $media = wp_get_attachment_image($atts['media_id'], 'content', false, [
    'class' => 'v2-donate-campaign__media'
  ]);

  return "<section class=\"v2-donate-campaign\">
    {$media}

    <div class=\"v2-donate-campaign__content-container\">
      <h2 class=\"v2-donate-campaign__title\">{$atts['title']}</h2>
      <p class=\"v2-donate-campaign__excerpt\">{$atts['excerpt']}</p>
      <div class=\"v2-donate-campaign__iframe\">{$twingle}</div>
    </div>
  </section>";
}

add_shortcode('donate_campaign', 'donate_campaign_shortcode');

?>
