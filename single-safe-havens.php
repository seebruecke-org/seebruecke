<?php get_header(); ?>

<main class="main">
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="constraint">
      <div class="action-single">
        <article class="richtext">
          <?php the_content(); ?>
        </article>
      </div>
    </div>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
