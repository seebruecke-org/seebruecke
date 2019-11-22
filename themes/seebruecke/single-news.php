<?php get_header('v2-single'); ?>

<main class="v2-main">
  <article class="v2-block-content">
      <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();

            if (has_excerpt()) :
      ?>
        <div class="v2-excerpt">
          <?php the_excerpt(); ?>
        </div>
      <?php
            endif;

            the_content();

          endwhile;
        endif;
      ?>
  </article>
</main>

<?php get_footer(); ?>
