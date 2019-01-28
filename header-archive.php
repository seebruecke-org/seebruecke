<!doctype html>

<html <?php language_attributes(); ?>>
  <?php get_template_part('html', 'head'); ?>
  <body>
    <?php
      wp_admin_bar_render();
      $archive = get_queried_object();
      $title = get_queried_object()->label;
    ?>

    <header class="header header--without-image">
      <?php get_template_part('navigation'); ?>

      <div class="header__content">
        <div class="constraint">
          <h1 class="header__title">
            <?php
              global $TITLE;

              if (isset($TITLE)) {
                echo $TITLE;
              } else {
                pll_e('Alle ' . $title);
              }
            ?>
          </h1>
        </div>
      </div>
    </header>

    <?php get_template_part('support'); ?>
