<?php

$post_types_with_date = ['news', 'events', 'pressrelease'];
$archive_translations = [
  'Events' => 'Alle Aktionen'
];

?>

<!doctype html>

<html <?php language_attributes(); ?>>

  <?php get_template_part('html', 'head'); ?>

  <body>
    <?php wp_admin_bar_render(); ?>

    <header class="v2-header">
      <?php
        wp_nav_menu([
          'theme_location' => 'header-secondary',
          'menu_class' => 'v2-header-menu-list-secondary',
          'container' => false
        ]);
      ?>

      <div class="v2-header-menu-before"></div>

      <?php get_template_part('logo'); ?>

      <nav class="v2-header-menu">
        <?php
          wp_nav_menu(
            array(
              'theme_location' => 'header-menu',
              'menu_class' => 'v2-header-menu-list',
              'container' => false,
              'walker' => new Navigation_Walker()
            )
          );
        ?>

        <button type="button" class="v2-burger js-burger" aria-label="Menü">
          <span class="v2-burger__bars"></span>
        </button>

        <?php get_template_part('social-media-v2'); ?>
      </nav>

      <?php if(!is_archive()) : ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div class="v2-header-single">
            <h1 class="v2-header-single__title">
              <?php if(in_array(get_post_type(), $post_types_with_date)) : ?>
                <small class="v2-header-single__date">
                  <?php if (get_post_type() !== 'events') : ?>
                    <?php the_date(); ?>
                  <?php else: ?>
                    <?php
                      $fields = get_post_custom();
                      echo date(get_date_format(), strtotime($fields['event_date'][0]));
                    ?>
                      um
                    <?php echo $fields['event_time'][0]; ?>
                      in
                    <?php
                      $address = $fields['event_city'][0];

                      if ($fields['event_address'][0]) {
                        $address .= ', ' . $fields['event_address'][0];
                      }

                      echo $address;
                    ?>
                  <?php endif; ?>
                </small>
              <?php endif; ?>

              <?php the_title(); ?>
            </h1>
          </div>
        <?php endwhile; endif; ?>
      <?php else: ?>
        <div class="v2-header-single">
          <h1 class="v2-header-single__title">
            <?php
              $title = get_queried_object()->label;

              if (isset($archive_translations[$title])) {
                echo $archive_translations[$title];
              } else {
                echo $title;
              }
            ?>
          </h1>
        </div>
      <?php endif; ?>
    </header>
