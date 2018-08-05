<!doctype html>

<html lang="en"
      class="no-js">

  <?php get_template_part('html', 'head'); ?>

  <body>
    <?php
      wp_admin_bar_render();
      $thumbnail_id = get_post_thumbnail_id();
    ?>

    <header class="header <?php if (!is_front_page() && $thumbnail_id) { echo 'header--small'; } elseif(!is_front_page() && !$thumbnail_id) { echo 'header--without-image'; } ?>">
      <a href="<?php echo home_url(); ?>">
        <span class="visually-hidden">
          <?php echo pll__('Zurück zur Seebrücke Startseite') ?>
        </span>
      </a>

      <div class="header__language-switcher">
        <?php get_template_part('language', 'switcher'); ?>
      </div>

      <?php
        if (is_front_page()) :
          $headers = get_latest_header();
          while ( $headers->have_posts() ) : $headers->the_post();

          $label = rwmb_meta('header_label');
          $reference = rwmb_meta('header_reference');

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
              <?php echo get_the_title(); ?>
            </h1>

            <?php if($label && $reference): ?>
              <a href="<?php the_permalink($reference); ?>"
                 class="header__action">
                <?php echo $label; ?>
              </a>
            <?php endif; ?>

            <div class="header__additional-content">
              <?php the_content(); ?>
            </div>
          </div>
        </div>

      <?php
          endwhile;
        elseif (!is_archive()) :
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
              <?php echo get_the_title(); ?>
            </h1>
          </div>
        </div>

      <?php endwhile; endif; ?>
    </header>

    <?php get_template_part('support'); ?>
