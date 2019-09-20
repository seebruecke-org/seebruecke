<?php
  $HEADER_ID = rwmb_meta('page_header_reference', null, get_queried_object_id());
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
              'container' => false
            )
          );
        ?>

        <?php get_template_part('v2-social-media'); ?>
      </nav>

      <div class="v2-header-single">
        <h1 class="v2-header-single__title">
          <?php echo the_title(); ?>
        </h1>

        <div class="v2-header-single__excerpt">
          <?php the_excerpt(); ?>
        </div>
      </div>
    </header>
