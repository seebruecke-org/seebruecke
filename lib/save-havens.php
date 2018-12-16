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

function shortcode_havens($atts = []) {
  function group_havens_by_state($havens) {
    $grouped = [];

    foreach($havens->posts as $haven) {
      $fields = get_post_custom($haven->ID);
      $district = $fields['haven_district'][0];

      if (!$district) {
        $district = 'Unsorted';
      }

      if (!$grouped[$district]) {
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

      if ($fields['haven_since'][0]) {
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
                <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="#dc6e28" d="M256 56c110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200-110.532 0-200-89.451-200-200 0-110.532 89.451-200 200-200m0-48C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 168c-44.183 0-80 35.817-80 80s35.817 80 80 80 80-35.817 80-80-35.817-80-80-80z"></path>
                </svg>
              </a>
            </div>
            <div class="action__content-container">
              <h4 class="action__title">
                ' . $meta . '
                <a href="' . $href . '" rel="nofollow">
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
    $coordinates = $fields['haven_coordinates'][0];

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

add_shortcode('safe-havens', 'shortcode_havens');

pll_register_string('group', 'Lokalgruppe');
pll_register_string('Alle Safe havens', 'Alle Lokalgruppen');
pll_register_string('next_actions', 'Nächste Aktion');
pll_register_string('auf', 'auf');

?>
