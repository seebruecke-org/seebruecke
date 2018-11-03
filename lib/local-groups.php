<?php

function get_all_localgroups($extend_query = []) {
  $args = array_merge(
    array(
      'orderby' => 'title',
      'order' => 'ASC',
      'post_type' => 'groups',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    ),
    $extend_query
  );

  $query = new WP_Query($args);

  return $query;
}

function shortcode_groups($atts = []) {
  function render_groups($groups) {
    $markup = '';

    foreach($groups->posts as $group) {
      $id = $group->ID;
      $fields = get_post_custom($id);
      $href = get_the_permalink($id);

      $markup .= '
        <li class="localgroups__group">
          <a href="' . $href . '" rel="nofollow" class="localgroups__group-title">
            ' . $group->post_title . '
          </a>
        </li>
      ';
    }

    return $markup;
  }

  $atts = array_change_key_case((array)$atts, CASE_LOWER);

  // map coordinates
  $groups = get_all_localgroups();
  $groups_json = [];

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
      <div class="map">
        <div class="map__canvas js-map"
            data-data=\'' . json_encode($groups_json) . '\'></div>
      </div>
      <ul class="localgroups__list">
        ' . render_groups($groups) . '
      </ul>
    </div>
  ';
}

add_shortcode('localgroups', 'shortcode_groups');

pll_register_string('all_groups', 'Alle Lokalgruppen');
pll_register_string('next_actions', 'Nächste Aktion');

?>
