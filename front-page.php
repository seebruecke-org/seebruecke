<!doctype html>

<html lang="en"
      class="no-js">

  <?php get_template_part('html', 'head'); ?>

  <body>
    <?php get_header('hero'); ?>

    <main class="main">
      <?php while ( have_posts() ) : the_post(); ?>
        <div class="constraint">
          <article class="richtext">
            <?php the_content(); ?>
          </article>
        </div>
      <?php endwhile; ?>
    </main>

    <?php get_footer(); ?>
