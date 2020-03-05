<?php

function get_all_havens($extend_query = []) {
  $args = array_merge(
    array(
      'orderby' => 'title',
      'order' => 'ASC',
      'post_type' => 'safe-havens',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    ),
    $extend_query
  );

  $query = new WP_Query($args);

  return $query;
}

function group_havens_by_state($havens) {
  $grouped = [];

  foreach($havens->posts as $haven) {
    $fields = get_post_custom($haven->ID);
    $district = $fields['haven_district'][0];

    if (!$district) {
      $district = 'Unsorted';
    }

    if (!isset($grouped[$district]) OR !is_array($grouped[$district])) {
      $grouped[$district] = [];
    }

    $grouped[$district][] = $haven;
  }

  ksort($grouped);

  return $grouped;
}

function render_list($havens) {
  $markup = '';
  $grouped = group_havens_by_state($havens);

  foreach($grouped as $state => $state_havens) {
    $markup .= '
      <li class="actions__day">
        <h3 class="actions__day-title">' . $state . '</h3>
        ' . render_havens($state_havens) . '
      </li>
    ';
  }

  return $markup;
}

function render_havens($havens) {
  $markup = '<ul class="actions__events">';

  foreach($havens as $haven) {
    $id = $haven->ID;
    $fields = get_post_custom($id);
    $href = get_the_permalink($id);
    $meta = '';

    if (isset($fields['haven_since'][0])) {
      $since = date(get_date_format(), strtotime($fields['haven_since'][0]));

      $meta = '<div class="action__meta">
        <small class="action__time">
          seit '. $since .'
        </small>
      </div>';
    }

    $markup .= '
      <li class="actions__action actions__action--wide">
        <div class="action">
          <div class="action__icon-container">
            <a href="' . $href . '" rel="nofollow">
              <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 288 512">
                <path fill="#dc6e28" d="M112 316.94v156.69l22.02 33.02c4.75 7.12 15.22 7.12 19.97 0L176 473.63V316.94c-10.39 1.92-21.06 3.06-32 3.06s-21.61-1.14-32-3.06zM144 0C64.47 0 0 64.47 0 144s64.47 144 144 144 144-64.47 144-144S223.53 0 144 0zm0 76c-37.5 0-68 30.5-68 68 0 6.62-5.38 12-12 12s-12-5.38-12-12c0-50.73 41.28-92 92-92 6.62 0 12 5.38 12 12s-5.38 12-12 12z"></path>
              </svg>
            </a>
          </div>
          <div class="action__content-container">
            <h4 class="action__title">
              ' . $meta . '
              <a href="' . $href . '">
                <span class="visually-hidden">
                  Sicherer Hafen:
                </span>
                ' . $fields['haven_address'][0] . '
              </a>
            </h4>
          </div>
        </div>
      </li>
    ';
  }

  $markup .= '</ul>';

  return $markup;
}

function shortcode_havens($atts = []) {
  $atts = array_change_key_case((array)$atts, CASE_LOWER);

  // map coordinates
  $havens = get_all_havens();
  $havens_json = [];

  $archive_class = '';

  if (is_archive()) {
    $archive_class = 'map--is-in-archive';
  }

  foreach($havens->posts as $group) {
    $id = $group->ID;
    $fields = get_post_custom($id);
    $coordinates = isset($fields['haven_coordinates'][0]) ? $fields['haven_coordinates'][0] : "";

    if($coordinates) {
      $havens_json[] = array(
        'coordinates' => $coordinates,
        'title' => get_the_title($id),
        'url' => get_the_permalink($id),
      );
    }
  }

  return '
    <div class="havens">
      <h2>' . sizeof($havens->posts) . ' ' . $atts['title'] . '</h2>

      <div class="map map--is-large ' . $archive_class . '">
        <div class="map__canvas js-map"
            data-icon="map-circle"
            data-show-label="true"
            data-data=\'' . json_encode($havens_json) . '\'></div>
      </div>

      <ul class="actions__list">
        ' . render_list($havens) . '
      </ul>
    </div>
  ';
}

function shortcode_demands()  {
  $post_id = get_the_ID();
  $demands = rwmb_meta('haven_demands', null, $post_id);
  $post_title = get_the_title();
  $post_district = rwmb_meta('haven_district', null, $post_id);

  function render_demand($post_title, $post_district, $demand) {
    $post = get_post($demand['haven_demand']);
    $title = $post->post_title;
    $content = $post->post_content;

    // Replace {location} placeholders
    $content = str_replace('{location}', $post_title, $content);

    // Replace {district} placeholders
    $content = str_replace('{district}', $post_district, $content);

    $icon_check = '<svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg>';
    $icon_question = '<svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M202.021 0C122.202 0 70.503 32.703 29.914 91.026c-7.363 10.58-5.093 25.086 5.178 32.874l43.138 32.709c10.373 7.865 25.132 6.026 33.253-4.148 25.049-31.381 43.63-49.449 82.757-49.449 30.764 0 68.816 19.799 68.816 49.631 0 22.552-18.617 34.134-48.993 51.164-35.423 19.86-82.299 44.576-82.299 106.405V320c0 13.255 10.745 24 24 24h72.471c13.255 0 24-10.745 24-24v-5.773c0-42.86 125.268-44.645 125.268-160.627C377.504 66.256 286.902 0 202.021 0zM192 373.459c-38.196 0-69.271 31.075-69.271 69.271 0 38.195 31.075 69.27 69.271 69.27s69.271-31.075 69.271-69.271-31.075-69.27-69.271-69.27z"></path></svg>';
    $icon_times = '<svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg>';

    switch($demand['haven_demand-decided']) {
      case 'yes':
        $decided = $icon_check;
        break;

      case 'no':
        $decided = $icon_times;
        break;

      default:
        $decided = $icon_question;
    }

    switch($demand['haven_demand-fullfilled']) {
      case 'yes':
        $fullfilled = $icon_check;
        break;

      case 'no':
        $fullfilled = $icon_times;
        break;

      default:
        $fullfilled = $icon_question;
    }

    return '<tr class="demands__demand">
      <td>
        <h3 class="demands__demand-title">' . $title . '</h3>
        <div class="demands__demand-content">' . $content . '</div>
      </td>
      <td class="demands__demand-decided">
        ' . $decided . '
      </td>
      <td class="demands__demand-fullfilled">
        ' . $fullfilled . '
      </td>
    </tr>';
  }

  function render_demands($title, $district, $demands) {
    $markup = '<table class="demands__table">
      <thead>
        <th></th>
        <th class="demands__demand-decided">Entschieden</th>
        <th>Umgesetzt</th>
      </thead>
      <tbody>
    ';

    foreach($demands as $demand) {
      $markup .= render_demand($title, $district, $demand);
    }

    return $markup . '
      </tbody>
    </table>';
  }

  return '<div class="demands">
    <div class="constraint">
      <h2 class="demands__title">Forderungen an ' . $post_title . '</h2>
      ' . render_demands($post_title, $post_district, $demands) .
    '</div>
  </div>';
}

function save_havens_register_post_type() {
  register_post_type('safe-havens',
    array(
      'labels' => array(
        'name' => 'Safe havens',
        'singular_name' => 'Safe haven'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-admin-multisite',
        'has_archive' => true,
        'rewrite' => array(
          'slug' => 'safe-havens'
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

add_action('init', 'save_havens_register_post_type');
add_shortcode('safe-havens', 'shortcode_havens');
add_shortcode('demands', 'shortcode_demands');

if (function_exists('pll_register_string')) {
  pll_register_string('group', 'Lokalgruppe');
  pll_register_string('Alle Safe havens', 'Alle Lokalgruppen');
  pll_register_string('next_actions', 'Nächste Aktion');
  pll_register_string('auf', 'auf');
}

?>
