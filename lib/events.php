<?php

function get_all_events($extend_query = []) {
  $args = array_merge(
    array(
      'meta_query' => array(
        array(
          'key' => 'event_date',
        )
      ),
      'orderby' => 'event_date',
      'order' => 'DESC',
      'post_type' => 'events',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    ),
    $extend_query
  );

  $query = new WP_Query($args);

  return $query;
}

function get_all_upcoming_events() {
  return get_all_events(array(
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => date('Y-m-d'),
        'type' => 'DATE',
      )
    ),
  ));
}

function get_all_upcoming_events_by_localgroup($id) {
  return get_all_events(array(
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => date('Y-m-d'),
        'type' => 'DATE',
      ),

      array(
        'key' => 'event_organizer',
        'compare' => '=',
        'value' => $id,
      )
    ),
  ));
}

function get_all_upcoming_events_by_tags($tags) {
  return get_all_events(array(
    'order' => 'ASC',
    'tag' => $tags,
    'meta_query' => array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => date('Y-m-d'),
        'type' => 'DATE',
      )
    ),
  ));
}

function shortcode_actions($atts = []) {
  function group_events_by_date($events) {
    $grouped = array();

    foreach($events as $event) {
      $id = $event->ID;
      $fields = get_post_custom($id);

      $grouped[$fields['event_date'][0]][] = $event;
    }

    return $grouped;
  }

  function render_events($events) {
    $markup = '';

    foreach($events as $event) {
      $id = $event->ID;
      $fields = get_post_custom($id);
      $href = get_the_permalink($id);

      $markup .= '
        <li class="actions__action">
          <div class="action">
            <div class="action__icon-container">
              <a href="' . $href . '" rel="nofollow">
                <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M576 224c0-20.896-13.36-38.666-32-45.258V64c0-35.346-28.654-64-64-64-64.985 56-142.031 128-272 128H48c-26.51 0-48 21.49-48 48v96c0 26.51 21.49 48 48 48h43.263c-18.742 64.65 2.479 116.379 18.814 167.44 1.702 5.32 5.203 9.893 9.922 12.88 20.78 13.155 68.355 15.657 93.773 5.151 16.046-6.633 19.96-27.423 7.522-39.537-18.508-18.026-30.136-36.91-19.795-60.858a12.278 12.278 0 0 0-1.045-11.673c-16.309-24.679-3.581-62.107 28.517-72.752C346.403 327.887 418.591 395.081 480 448c35.346 0 64-28.654 64-64V269.258c18.64-6.592 32-24.362 32-45.258zm-96 139.855c-54.609-44.979-125.033-92.94-224-104.982v-69.747c98.967-12.042 169.391-60.002 224-104.982v279.711z"></path></svg>
              </a>
            </div>

            <div class="action__content-container">
              <h4 class="action__title">
                <div class="action__meta">
                  <small class="action__time">'
                    . $fields['event_time'][0] .
                  '</small>
                </div>

                <a href="' . $href . '">
                  ' . $fields['event_city'][0] . '
                </a>
              </h4>

              <p class="action__content">' . $event->post_title . '</p>
            </div>
          </div>
        </li>
      ';
    }

    return '
      <ul class="actions__events">' . $markup . '</ul>
    ';
  }

  function render_days($show_only_upcoming, $show_upcoming_count, $filter_by_tags) {
    $markup = '';

    if ($show_only_upcoming) {
      if ($filter_by_tags) {
        $events = get_all_upcoming_events_by_tags($filter_by_tags);
      } else {
        $events = get_all_upcoming_events();
      }
    } else {
      $events = get_all_events();
    }

    $events_grouped = group_events_by_date($events->posts);

    if($show_upcoming_count) {
      $events_grouped = array_slice($events_grouped, 0, (int)$show_upcoming_count);
    }

    foreach($events_grouped as $date => $event) {
      $id = $event->ID;
      $fields = get_post_custom($id);

      $markup .= '
        <li class="actions__day">
          <h3 class="actions__day-title">
            ' . date(get_date_format(), strtotime($date)) . '
          </h3>
          ' . render_events($event) . '
        </li>
      ';
    }

    return $markup;
  }

  $atts = array_change_key_case((array)$atts, CASE_LOWER);
  $slug = pll_current_language('slug');
  $slug = $slug == 'de' ? '' : ( '/' . $slug );
  $url = $slug . '/events/';
  $all_markup = '';
  $archive_class = '';

  if (is_archive()) {
    $archive_class = 'map--is-in-archive';
  }

  if (!is_archive()) {
    $all_markup = '
      <a href="' . $url . '" class="actions__more">
        ' . pll__('Alle Aktionen') . '
      </a>
    ';
  }

  $show_only_upcoming = array_key_exists('upcoming', $atts) || in_array('upcoming', $atts);
  $show_upcoming_count = $atts['upcoming'];
  $filter_by_tags = $atts['tags'];

  // map coordinates
  if ($filter_by_tags) {
    $events = get_all_upcoming_events_by_tags($filter_by_tags);
  } else {
    $events = get_all_upcoming_events();
  }

  $events_json = [];

  foreach($events->posts as $event) {
    $id = $event->ID;
    $fields = get_post_custom($id);
    $coordinates = $fields['event_coordinates'][0];

    if($coordinates) {
      $events_json[] = array(
        'coordinates' => $coordinates,
        'title' => get_the_title($id),
        'url' => get_the_permalink($id),
      );
    }
  }

  return '
    <div class="actions">
      <div class="map map--is-large ' . $archive_class . '">
        <div class="map__canvas js-map"
            data-data=\'' . json_encode($events_json) . '\'></div>
      </div>
      <ul class="actions__list">
      ' . render_days($show_only_upcoming, $show_upcoming_count, $filter_by_tags) . '
      </ul>
      ' . $all_markup . '
    </div>
  ';
}

function feed_events() {
  $post_types = array(
    'events'
  );

  foreach($post_types as $post_type) {
    $feed = get_post_type_archive_feed_link($post_type);

    if ($feed === '' || !is_string( $feed )) {
      $feed = get_bloginfo('rss2_url') . '?post_type=' . $post_type;
    }

    printf(
      __('<link rel="%1$s" type="%2$s" href="%3$s" />'), 'alternate', 'application/rss+xml', $feed);
  }
}

add_shortcode('actions', 'shortcode_actions');

pll_register_string('Alle Events', 'Alle Aktionen');

?>
