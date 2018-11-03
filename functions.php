<?php

global $GOOGLE_MAPS_API_KEY;

$GOOGLE_MAPS_API_KEY = 'AIzaSyAhnc8DKVnhU-TidKa_gBF1086Th_VHPGM';

require('lib/events.php');
require('lib/local-groups.php');

function get_all_organizations() {
  return new WP_Query(array(
    'orderby' => 'title',
    'order' => 'ASC',
    'post_type' => 'organizations',
    'post_status' => 'publish',
    'posts_per_page' => -1,
  ));
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

function get_latest_footer() {
  return new WP_Query(
    array(
      'post_type' => 'footers',
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
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'has_archive' => false,
        'supports' => array(
          'title',
          'editor',
          'thumbnail',
          'revisions',
        )
    )
  );

  register_post_type('footers',
    array(
      'labels' => array(
        'name' => pll__('Footers'),
        'singular_name' => pll__('Footer')
        ),
        'public' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'has_archive' => false,
        'supports' => array(
          'editor',
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
        'rewrite' => array(
          'slug' => 'events'
        ),
        'taxonomies' => array(
          'post_tag',
        ),
        'supports' => array(
          'author',
          'title',
          'editor',
          'thumbnail',
          'revisions',
        )
    )
  );

  register_post_type('safe-havens',
    array(
      'labels' => array(
        'name' => pll__('Safe havens'),
        'singular_name' => pll__('Safe haven')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
          'slug' => 'safe-havens'
        ),
        'supports' => array(
          'title',
          'editor',
          'thumbnail',
          'revisions',
        )
    )
  );

  register_post_type('organizations',
    array(
      'labels' => array(
        'name' => pll__('Organisations'),
        'singular_name' => pll__('Organisation')
        ),
        'public' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'has_archive' => false,
        'supports' => array(
          'title',
        )
    )
  );

  register_post_type('groups',
    array(
      'labels' => array(
        'name' => pll__('Local groups'),
        'singular_name' => pll__('Local group')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
          'slug' => 'groups'
        ),
        'supports' => array(
          'author',
          'title',
          'editor',
          'thumbnail',
          'revisions',
        )
    )
  );
}

function register_meta_boxes($meta_boxes) {
  global $GOOGLE_MAPS_API_KEY;

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

      // Secondary action
      array(
        'name'  => 'Secondary action text',
        'desc'  => '(Label of the secondary button)',
        'id'    => 'header_secondary_label',
        'type'  => 'text',
      ),

      array(
        'name'  => 'Secondary link target',
        'desc'  => '(Link target of the secondary button)',
        'id'    => 'header_secondary_reference',
        'type'  => 'text',
      ),

      // Support widget
      array(
        'name'  => 'Support text',
        'id'    => 'header_support_label',
        'type'  => 'text',
      ),

      array(
        'name'  => 'Facebook-Link',
        'id'    => 'header_support_facebook',
        'post_type' => 'text',
      ),

      array(
        'name'  => 'Instagram-Link',
        'id'    => 'header_support_instagram',
        'post_type' => 'text',
      ),

      array(
        'name'  => 'Twitter-Link',
        'id'    => 'header_support_twitter',
        'post_type' => 'text',
      ),

      array(
        'name'  => 'Youtube-Link',
        'id'    => 'header_support_youtube',
        'post_type' => 'text',
      ),
    ),
  );

  // Save havens
  $meta_boxes[] = array(
    'id'         => 'haven_data',
    'title'      => 'Extended information',
    'post_types' => 'safe-havens',
    'context'    => 'normal',
    'priority'   => 'high',
    'fields' => array(
      array(
        'name'  => 'City name',
        'id'    => 'haven_address',
        'type'  => 'text',
      ),

      array(
        'api_key' => $GOOGLE_MAPS_API_KEY,
        'name'  => 'Location',
        'id'    => 'haven_coordinates',
        'type'  => 'map',
        'address_field' => 'haven_address',
      ),
    )
  );

  // Events
  $meta_boxes[] = array(
    'id'         => 'event_data',
    'title'      => 'Extended information',
    'post_types' => 'events',
    'context'    => 'normal',
    'priority'   => 'high',
    'fields' => array(
        array(
            'name'  => 'City',
            'id'    => 'event_city',
            'type'  => 'text',
        ),

        array(
            'name'  => 'Address',
            'desc'  => 'Address of the location (excluding the city name)',
            'id'    => 'event_address',
            'type'  => 'text',
        ),

        array(
          'api_key' => $GOOGLE_MAPS_API_KEY,
          'name'  => 'Location',
          'desc'  => 'Coordinates of the location',
          'id'    => 'event_coordinates',
          'type'  => 'map',
          'address_field' => 'event_address',
        ),

        array(
          'name'  => 'Date',
          'desc'  => 'When does the event take place?',
          'id'    => 'event_date',
          'type'  => 'date',
        ),

        array(
          'name'  => 'Time',
          'desc'  => 'When does the event take place?',
          'id'    => 'event_time',
          'type'  => 'time',
        ),

        array(
          'name'  => 'Type',
          'desc'  => 'Which kind of event is it?',
          'id'    => 'event_type',
          'type'  => 'select',
          'options' => array(
            'kundgebung' => pll__('Kundgebung'),
            'flashmob' => pll__('Flashmob'),
            'demo' => pll__('Demo'),
            'planungstreffen' => pll__('Planungstreffen'),
            'filmvorführung' => pll__('Filmvorführung'),
            'bastelaktion' => pll__('Bastelaktion'),
            'aktion' => pll__('Aktion'),
            'mahnwache' => pll__('Mahnwache'),
          ),
          'multiple' => false,
        ),

        array(
          'name'  => 'Link',
          'desc'  => '',
          'id'    => 'event_link',
          'type'  => 'text',
        ),

        array(
          'id' => 'event_organizer',
          'type' => 'post',
          'name' => 'Organizer (Local group)',
          'post_type' => 'groups',
          'field_type' => 'select_advanced',
        ),
      )
  );

  // Local groups
  $meta_boxes[] = array(
    'id'         => 'groups_data',
    'title'      => 'Extended information',
    'post_types' => 'groups',
    'context'    => 'normal',
    'priority'   => 'high',
    'fields'     => array(
        array(
          'name'  => 'City',
          'id'    => 'group_address',
          'type'  => 'text',
      ),

      array(
        'api_key' => $GOOGLE_MAPS_API_KEY,
        'name'  => 'Location',
        'desc'  => 'Coordinates of the group',
        'id'    => 'group_coordinates',
        'type'  => 'map',
        'address_field' => 'group_address',
      ),

      array(
        'name'  => 'Facebook',
        'desc'  => 'Link to the facebook page',
        'id'    => 'group_facebook',
        'type'  => 'text',
      ),

      array(
        'name'  => 'Twitter',
        'desc'  => 'Link to the twitter account',
        'id'    => 'group_twitter',
        'type'  => 'text',
      ),

      array(
        'name'  => 'Instagram',
        'desc'  => 'Link to the instagram account',
        'id'    => 'group_instagram',
        'type'  => 'text',
      ),

      array(
        'name'  => 'Youtube',
        'desc'  => 'Link to the youtube account',
        'id'    => 'group_youtube',
        'type'  => 'text',
      ),

      array(
        'name'  => 'Email',
        'id'    => 'group_email',
        'type'  => 'text',
      ),
    ),
  );

  // Organizations
  $meta_boxes[] = array(
    'id'         => 'organization_data',
    'title'      => 'Extended information',
    'post_types' => 'organizations',
    'context'    => 'normal',
    'priority'   => 'high',
    'fields'     => array(
      array(
        'name'  => 'URL',
        'desc'  => '(Link to the Organization)',
        'id'    => 'organization_link',
        'type'  => 'text',
      ),
    ),
  );

  // Footer
  $meta_boxes[] = array(
    'id'         => 'footer_data',
    'title'      => 'Extended information',
    'post_types' => 'footers',
    'context'    => 'normal',
    'priority'   => 'high',
    'fields'     => array(
      array(
        'name'  => 'Mailchimp URL',
        'id'    => 'mailchimp_url',
        'type'  => 'text',
      ),

      array(
        'name'  => 'Mailchimp Enabled',
        'id'    => 'mailchimp_enabled',
        'type'  => 'checkbox',
        'std'   => 0,
      ),
    ),
  );

  return $meta_boxes;
}

function shortcode_supporting_organizations($atts = []) {
  $atts = array_change_key_case((array)$atts, CASE_LOWER);

  function render_organizations() {
    $organizations = get_all_organizations();
    $markup = '';

    foreach($organizations->posts as $organization) {
      $id = $organization->ID;
      $fields = get_post_custom($id);

      $markup .= '
        <li class="supporting-organizations__organization">
          <a href="' . $fields['organization_link'][0] . '"
             rel="nofollow"
             class="supporting-organizations__organization-link">
            ' . $organization->post_title . '
          </a>
        </li>
      ';
    }

    return $markup;
  }

  return '
    <div class="supporting-organizations">
      <div class="constraint">
        <ul class="supporting-organizations__list">
          ' . render_organizations() . '
        </ul>
      </div>
    </div>
  ';
}

function shortcode_donate($atts = []) {
  $atts = array_change_key_case((array)$atts, CASE_LOWER);

  return '
    <div class="donate">
      <div class="constraint">
        <a href="' . $atts['href'] . '"
           class="donate__button">
          ' . $atts['label'] . '
        </a>
      </div>
    </div>
  ';
}

function shortcode_become_supporter($atts = [], $content = null) {
  $atts = array_change_key_case((array)$atts, CASE_LOWER);

  return '
    <ol class="become-supporter">'
      . do_shortcode($content) .
    '</ol>
  ';
}

function shortcode_become_supporter_item($atts = [], $content = null) {
  $atts = array_change_key_case((array)$atts, CASE_LOWER);

  $icons = array(
    'flag' => '<svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M349.565 98.783C295.978 98.783 251.721 64 184.348 64c-24.955 0-47.309 4.384-68.045 12.013a55.947 55.947 0 0 0 3.586-23.562C118.117 24.015 94.806 1.206 66.338.048 34.345-1.254 8 24.296 8 56c0 19.026 9.497 35.825 24 45.945V488c0 13.255 10.745 24 24 24h16c13.255 0 24-10.745 24-24v-94.4c28.311-12.064 63.582-22.122 114.435-22.122 53.588 0 97.844 34.783 165.217 34.783 48.169 0 86.667-16.294 122.505-40.858C506.84 359.452 512 349.571 512 339.045v-243.1c0-23.393-24.269-38.87-45.485-29.016-34.338 15.948-76.454 31.854-116.95 31.854z"></path></svg>',
    'bulhorn' => '<svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M576 224c0-20.896-13.36-38.666-32-45.258V64c0-35.346-28.654-64-64-64-64.985 56-142.031 128-272 128H48c-26.51 0-48 21.49-48 48v96c0 26.51 21.49 48 48 48h43.263c-18.742 64.65 2.479 116.379 18.814 167.44 1.702 5.32 5.203 9.893 9.922 12.88 20.78 13.155 68.355 15.657 93.773 5.151 16.046-6.633 19.96-27.423 7.522-39.537-18.508-18.026-30.136-36.91-19.795-60.858a12.278 12.278 0 0 0-1.045-11.673c-16.309-24.679-3.581-62.107 28.517-72.752C346.403 327.887 418.591 395.081 480 448c35.346 0 64-28.654 64-64V269.258c18.64-6.592 32-24.362 32-45.258zm-96 139.855c-54.609-44.979-125.033-92.94-224-104.982v-69.747c98.967-12.042 169.391-60.002 224-104.982v279.711z"></path></svg>',
    'users' => '<svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"></path></svg>',
  );
  $icon = $atts['icon'];

  if ($icon) {
    $icon_markup = '<div class="become-supporter__icon-container">' . $icons[$icon] . '</div>';
  } else {
    $icon_markup = '';
  }

  $title = $atts['title'];
  $title_markup = $title ? '<h3 class="become-supporter__title">' . $title . '</h3>' : '';

  return '
    <li class="become-supporter__item">
      ' . $icon_markup . '
      ' . $title_markup . '
      <div class="become-supporter__content">'. $content . '</div>
    </li>
  ';
}

function shortcode_paypal() {
  return '
    <form action="https://www.paypal.com/cgi-bin/webscr"
          method="post"
          target="_top">
      <input name="cmd"
             type="hidden"
             value="_s-xclick" />
      <input name="hosted_button_id"
             type="hidden"
             value="NMGH6PJ5D9LKQ" />
      <input alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal." name="submit"
             src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif"
             type="image" />
      <img style="display: none !important;"
           hidden=""
           src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif"
           alt="" width="1"
           height="1"
           border="0" />
  </form>
  ';
}

function shortcode_twingle() {
  return '
  <script type="text/javascript">
    (function() {
    var u="https://spenden.twingle.de/embed/mensch-mensch-mensch-e-v/seebrcke/tw5b90e51600cb6/form";
    var id = "_" + Math.random().toString(36).substr(2, 9);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0];
    document.write("<div id=\"twingle-public-embed-" + id + "\"></div>");
    g.type="text/javascript"; g.async=true; g.defer=true; g.src=u+"/"+id; s.parentNode.insertBefore(g,s);
    })();
  </script>
  ';
}

function shortcode_featured($atts = []) {
  $atts = array_change_key_case((array)$atts, CASE_LOWER);
  $id = $atts['id'];
  $title = $atts['title'] ? $atts['title'] : get_the_title($id);
  $subtitle = $atts['subtitle'];
  $subtitle_markup = '';
  $href = get_the_permalink($id);
  $image = get_the_post_thumbnail($id, 'hero-image', array(
    'class' => 'featured__image'
  ));

  if ($subtitle) {
    $subtitle_markup = '
      <small class="featured__subtitle">
        ' . $subtitle . '
      </small>
    ';
  }

  return '
    <section class="featured">
      ' . $image . '
      <h3 class="featured__title">
        ' . $subtitle_markup . '

        <a href="' . $href . '">
          ' . $title . '
        </a>
      </h3>
    </section>
  ';
}

function cleanup_admin() {
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
}

function remove_wp_version() {
  return '';
}

function enqueue_scripts() {
  $main_path = '/dist/main.css';
  $main = get_stylesheet_directory() . $main_path;
  $main_uri = get_template_directory_uri() . $main_path;

  wp_enqueue_style('style', $main_uri, false, filemtime($main));

  $main_js_path = '/dist/main.js';
  $main_js = get_template_directory() . $main_js_path;
  $main_js_uri = get_template_directory_uri() . $main_js_path;

  wp_register_script(
    'main_js',
    $main_js_uri,
    array(),
    filemtime($main_js)
  );

  wp_enqueue_script('main_js');

  if(is_user_logged_in()) {
    $admin_path = '/dist/admin.js';
    $admin_js = get_template_directory() . $admin_path;
    $admin_js_uri = get_template_directory_uri() . $admin_path;

    wp_register_script(
      'admin_js',
      $admin_js_uri,
      array(
        'jquery'
      ),
      filemtime($admin_js)
    );

    wp_enqueue_script('admin_js');
  }
}

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ('dns-prefetch' == $relation_type) {
    $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
    $urls = array_diff($urls, array( $emoji_svg_url ));
  }

  return $urls;
}

function disable_emojis_tinymce($plugins) {
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}

function disable_emojis() {
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

  add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
  add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}

function get_date_format() {
  return pll__('d.m.Y');
}

add_action('init', 'disable_emojis');
add_action('wp_head', 'feed_events');

add_action('init', 'create_posttypes');
add_filter('rwmb_meta_boxes', 'register_meta_boxes');

add_theme_support('post-thumbnails');

add_filter('the_generator', 'remove_wp_version');
add_action('admin_menu','cleanup_admin');

add_shortcode('donate', 'shortcode_donate');
add_shortcode('become_supporter', 'shortcode_become_supporter');
add_shortcode('become_supporter_item', 'shortcode_become_supporter_item');
add_shortcode('supporting_organizations', 'shortcode_supporting_organizations');
add_shortcode('paypal', 'shortcode_paypal');
add_shortcode('featured', 'shortcode_featured');
add_shortcode('twingle', 'shortcode_twingle');

add_action('wp_enqueue_scripts', 'enqueue_scripts');

/* image sizes */
add_image_size('hero-image', 2400, 9999);

/* custom strings */
pll_register_string('archive_events', 'Alle Aktionen');
pll_register_string('all_events', 'Alle Aktionen');
pll_register_string('back_to_homepage_short', 'Zurück zur Startseite');
pll_register_string('date_format', 'd.m.Y');
pll_register_string('at', 'um');
pll_register_string('time', 'Uhrzeit');
pll_register_string('location', 'Ort');
pll_register_string('link', 'Link');
pll_register_string('link_to_event', 'Link zum Event');
pll_register_string('language', 'Sprache:');

/* Newsletter Subscribe */
pll_register_string('newsletter_subscribe', 'Newsletter abonnieren');
pll_register_string('newsletter_subscribe_action', 'Abonnieren');
pll_register_string('newsletter_subscribe_email', 'Deine Email Adresse');
pll_register_string('newsletter_subscribe_intro', 'SEEBRÜCKE wird die Daten, die du in diesem Formular angibst, dazu verwenden, um mit dir in Kontakt zu bleiben und dir Updates und News zu unserer Arbeit zu schicken.');
pll_register_string('newsletter_subscribe_confirm', 'Ja, ich möchte per E-Mail informiert werden.');
pll_register_string('newsletter_subscribe_gdpr_1', 'Du kannst deine Meinung jederzeit ändern, indem du auf den Abbestellungs-Link klickst, den du in der Fußzeile jeder E-Mail, die du von uns erhältst, finden kannst, oder indem du uns unter action@seebruecke.org kontaktierst. Wir werden deine Daten mit Sorgfalt und Respekt behandeln. Weitere Informationen zu unseren Datenschutzpraktiken findest du auf unserer Website. Indem du unten auf "Für die Liste anmelden" klickst, erklärst du dich damit einverstanden, dass wir deine Daten in Übereinstimmung mit diesen Bedingungen verarbeiten dürfen.');
pll_register_string('newsletter_subscribe_gdpr_2', 'Wir verwenden MailChimp als unsere Marketing-Plattform. Wenn Sie unten auf "Abonnieren" klicken, bestätigen Sie, dass Ihre Daten zur Verarbeitung an MailChimp übertragen werden. Bitte klicken Sie <a href="https://mailchimp.com/legal/" rel="nofollow">hier</a>, um mehr über die Datenschutzpraktiken von MailChimp zu erfahren.');

?>
