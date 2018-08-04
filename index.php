<?php get_header(); ?>

<main>
  <?php /* render main page content */ ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="constraint">
      <article class="richtext">
        <?php the_content(); ?>
      </article>
    </div>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
