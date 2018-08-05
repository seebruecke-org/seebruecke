<?php get_header(); ?>

<main class="main">
  <?php /* render main page content */ ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="constraint">
      <ul class="archive-events">
        <li>
          <h2>
            <a href="<?php the_permalink(); ?>">
              <?php the_title(); ?></h2>
            </a>
          </h2>
        </li>
      </ul>
    </div>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
