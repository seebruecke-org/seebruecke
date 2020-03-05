<?php

function get_all_localgroups($extend_query = []) {
  $args = array_merge(
    array(
      'orderby' => 'title',
      'order' => 'ASC',
      'post_type' => 'lokalgruppen',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    ),
    $extend_query
  );

  $query = new WP_Query($args);

  return $query;
}

function group_groups_by_state($groups) {
  $grouped = [];

  foreach($groups->posts as $group) {
    $fields = get_post_custom($group->ID);
    $district = isset($fields['group_district'][0]) ? $fields['group_district'][0] : 'Unsorted';

    if (!isset($grouped[$district]) OR empty($grouped[$district])) {
      $grouped[$district] = [];
    }

    $grouped[$district][] = $group;
  }

  ksort($grouped);

  return $grouped;
}

function render_groups($groups) {
  $markup = '<ul class="actions__events">';

  foreach($groups as $group) {
    $id = $group->ID;
    $fields = get_post_custom($id);
    $href = get_the_permalink($id);
    $meta = '';

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
              <a href="' . $href . '">
                <span class="visually-hidden">
                  Lokalgruppe:
                </span>
                ' . $fields['group_address'][0] . '
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

function render_list($groups) {
  $markup = '';

  $groups_sorted = group_groups_by_state($groups);

  foreach($groups_sorted as $state => $state_groups) {
    if (!isset($group->ID)) {
      continue;
    }

    $id = $group->ID;
    $fields = get_post_custom($id);
    $href = get_the_permalink($id);

    $markup .= '
      <li class="localgroups__group">
        <h3 class="actions__day-title">' . $state . '</h3>
        ' . render_groups($state_groups) . '
      </li>
    ';
  }

  return $markup;
}

function shortcode_groups($atts = []) {
  $atts = array_change_key_case((array)$atts, CASE_LOWER);

  // map coordinates
  $groups = get_all_localgroups();
  $groups_json = [];

  $archive_class = '';

  if (is_archive()) {
    $archive_class = 'map--is-in-archive';
  }

  foreach($groups->posts as $group) {
    $id = $group->ID;
    $fields = get_post_custom($id);
    $coordinates = $fields['group_coordinates'][0];

    if($coordinates) {
      $groups_json[] = array(
        'coordinates' => $coordinates,
        'title' => get_the_title($id),
        'url' => get_the_permalink($id),
      );
    }
  }

  return '
    <div class="localgroups">
      <div class="map map--is-large ' . $archive_class . '">
        <div class="map__canvas js-map"
            data-data=\'' . json_encode($groups_json) . '\'></div>
      </div>
      <ul class="localgroups__list">
        ' . render_list($groups) . '
      </ul>
    </div>
  ';
}

function localgroups_register_post_type() {
  register_post_type('lokalgruppen',
    array(
      'labels' => array(
        'name' => 'Local groups',
        'singular_name' => 'Local group'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-groups',
        'has_archive' => true,
        'rewrite' => array(
          'slug' => 'lokalgruppen'
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

add_action('init', 'localgroups_register_post_type');
add_shortcode('localgroups', 'shortcode_groups');

if (function_exists('pll_register_string')) {
  pll_register_string('group', 'Lokalgruppe');
  pll_register_string('all_groups', 'Alle Lokalgruppen');
  pll_register_string('next_actions', 'Nächste Aktion');
  pll_register_string('auf', 'auf');
}

?>
