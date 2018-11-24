<!doctype html>

<html <?php language_attributes(); ?>>

  <?php get_template_part('html', 'head'); ?>

  <body>
    <?php
      wp_admin_bar_render();
      $thumbnail_id = get_post_thumbnail_id();
    ?>

    <header class="header <?php if (!is_front_page() && $thumbnail_id) { echo 'header--small'; } elseif(!is_front_page() && !$thumbnail_id) { echo 'header--without-image'; } ?>">
      <?php get_template_part('navigation'); ?>

      <a href="<?php echo pll_home_url(); ?>"
         class="header__logo-container">
        <?php get_template_part('logo'); ?>
        <span class="visually-hidden">
          <?php echo pll__('Zurück zur Startseite') ?>
        </span>
      </a>

      <?php
        if (!is_archive()) :
          while ( have_posts() ) : the_post();

          $thumbnail_id = get_post_thumbnail_id();
          $thumbnail_attrs = array(
            'class' => 'header__image',
          );

          if($thumbnail_id) {
            echo wp_get_attachment_image(
              $thumbnail_id,
              'hero-image',
              false,
              $thumbnail_attrs
            );
          }
      ?>

        <div class="header__content">
          <div class="constraint">
            <h1 class="header__title">
              <?php if (isset($TITLE)) { echo $TITLE; } else { echo get_the_title(); } ?>
            </h1>
          </div>
        </div>

      <?php endwhile; endif; ?>
    </header>
