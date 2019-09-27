<?php get_header('v2-single'); ?>

<main class="v2-main">
  <article class="v2-block-content">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
  </article>
</main>

<?php get_footer(); ?>
