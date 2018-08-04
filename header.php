<!doctype html>

<html lang="en"
      class="no-js">
  <head>
    <meta charset="utf-8" />

    <script type="text/javascript">
      var html = document.querySelector('html');
      var removeJSClass = function(el) {
        el.classList.remove('no-js');
      }

      if (html) {
        removeJSClass(html);
      }
    </script>

    <meta http-equiv="x-ua-compatible"
          content="ie=edge" />

    <meta name="viewport"
          content="width=device-width, initial-scale=1" />

    <title>
      <?php wp_title(' - ', true, 'right'); ?>
      <?php bloginfo('name'); ?>
    </title>

    <link rel="shortcut icon"
          href="<?php bloginfo('template_directory'); ?>/favicon.ico" />

    <?php wp_head(); ?>
  </head>

  <body>
    <?php
      wp_admin_bar_render();
    ?>

    <header class="header">
      <div class="header__logo-container">
        <?php /* include(get_template_directory() . '/assets/images/seebruecke-logo.svg'); */ ?>
      </div>

      <a href="<?php echo home_url(); ?>">
        Back to Seebruecke Startpage
      </a>

      <ul class="language-switcher">
        <?php
          $languages = pll_the_languages( array( 'raw' => 1 ) );
          foreach($languages as $language):
        ?>
            <li class="language-switcher__item">
              <a href="<?php echo $language['url']; ?>"
                 class="language-switcher__language">
                <?php echo $language['name']; ?>
              </a>
            </li>
        <?php
          endforeach;
        ?>
      </ul>

      <div class="header__content">
        <div class="constraint">
          <?php
            if (is_front_page()) :
              $headers = get_latest_header();
              while ( $headers->have_posts() ) : $headers->the_post();
              
              $label = rwmb_meta('header_label');
              $reference = rwmb_meta('header_reference');
          ?>

            <h1>
              <?php echo get_the_title(); ?>
            </h1>

          <?php
            if($label && $reference):
          ?>
            <a href="<?php the_permalink($reference); ?>">
              <?php echo $label; ?>
            </a>
          <?php endif; ?>

          <?php
              endwhile;
            else :
              while ( have_posts() ) : the_post();
          ?>

            <h1>
                <?php echo get_the_title(); ?>
            </h1>

          <?php
              endwhile;
            endif;
          ?>
        </div>
      </div>

      <div class="support">
        <div class="constraint">
          <em class="support__label">Unterstütze die Bewegung!</em>

          <a href="">facebook</a>
          <a href="">twitter</a>
          <a href="">instagram</a>
        </div>
      </div>
    </header>
