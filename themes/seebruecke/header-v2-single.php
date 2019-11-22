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

        <?php get_template_part('social-media-v2'); ?>
      </nav>

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="v2-header-single">
          <h1 class="v2-header-single__title">
            <?php if(get_post_type() === 'news' || get_post_type() === 'events' || get_post_type() === 'pressrelease') : ?>
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
    </header>
