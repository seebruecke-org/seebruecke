<!doctype html>

<html <?php language_attributes(); ?>>
  <?php get_template_part('html', 'head'); ?>
  <body>
    <?php wp_admin_bar_render(); ?>

    <header class="header">
      <?php get_template_part('navigation'); ?>

      <?php get_template_part('logo'); ?>

      <?php
        global $header_id;

        $label = rwmb_meta('header_label', null, $header_id);
        $reference = rwmb_meta('header_reference', null, $header_id);

        $secondary_label = rwmb_meta('header_secondary_label', null, $header_id);
        $secondary_reference = rwmb_meta('header_secondary_reference', null, $header_id);

        $thumbnail_id = get_post_thumbnail_id($header_id);
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
              <?php echo get_the_title($header_id); ?>
            </h1>

            <?php if($label && $reference): ?>
              <a href="<?php the_permalink($reference); ?>"
                  class="header__action">
                <?php echo $label; ?>
              </a>
            <?php endif; ?>

            <?php if($secondary_label && $secondary_reference): ?>
              <div>
                <a href="<?php echo $secondary_reference; ?>"
                    class="header__secondary-action">
                  <?php echo $secondary_label; ?>
                </a>
              </div>
            <?php endif; ?>

            <div class="header__additional-content">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
    </header>

    <?php get_template_part('support'); ?>
