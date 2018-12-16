<nav class="navigation">
  <div class="navigation__language-switch">
    <?php get_template_part('language', 'switcher'); ?>
  </div>

  <div class="navigation__container">
    <div class="navigation__logo">
      <?php get_template_part('logo'); ?>
    </div>

    <?php
      if (has_nav_menu('header-menu') ) {
        wp_nav_menu(
          array(
            'theme_location' => 'header-menu',
            'container' => false
          )
        );
      }
    ?>
  </div>
</nav>
