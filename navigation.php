<nav class="navigation js-navigation">
  <div class="navigation__secondary">
    <div class="navigation__language-switch">
      <?php get_template_part('language', 'switcher'); ?>
      <?php
        wp_nav_menu([
          'theme_location' => 'header-secondary',
          'container' => false
        ]);
      ?>
    </div>
  </div>

  <div class="navigation__primary">
    <div class="navigation__logo">
      <?php get_template_part('logo'); ?>
    </div>

    <?php
      if (has_nav_menu('header-menu') ) :
    ?>
      <div class="navigation__burger-container">
        <button type="button" aria-label="Toggle Menu" class="burger-menu js-menu-burger">
          <svg aria-hidden="true" class="burger-menu__icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
          </svg>
        </button>
      </div>

      <?php
        wp_nav_menu(
          array(
            'theme_location' => 'header-menu',
            'container' => false
          )
        );

        endif;
    ?>
  </div>
</nav>
