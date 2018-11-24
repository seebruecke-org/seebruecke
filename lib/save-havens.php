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
  function render_havens($havens) {
    $markup = '';

    foreach($havens->posts as $haven) {
      $id = $haven->ID;
      $fields = get_post_custom($id);
      $href = get_the_permalink($id);

      $markup .= '
        <li class="localgroups__group">
          <a href="' . $href . '" rel="nofollow" class="localgroups__group-title">
            ' . $haven->post_title . '
          </a>
        </li>
      ';
    }

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
    <div class="localgroups">
      <div class="map map--is-large ' . $archive_class . '">
        <div class="map__canvas js-map"
            data-icon="map-circle"
            data-show-label="true"
            data-data=\'' . json_encode($havens_json) . '\'></div>
      </div>
      <ul class="localhavens__list">
        ' . render_havens($havens) . '
      </ul>
    </div>
  ';
}

add_shortcode('safe-havens', 'shortcode_havens');

pll_register_string('group', 'Lokalgruppe');
pll_register_string('all_groups', 'Alle Lokalgruppen');
pll_register_string('next_actions', 'Nächste Aktion');
pll_register_string('auf', 'auf');

?>
