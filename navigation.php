<?php
  if (has_nav_menu('theme_location') ) {
    wp_nav_menu(array('theme_location' => 'header-menu'));
  }
?>

<div class="header__language-switcher">
  <?php get_template_part('language', 'switcher'); ?>
</div>
