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

  <?php /* render next actions */ ?>
  <section class="constraint">
    <h2>Nächste Aktionen</h2>
    <?php
      $events = get_all_events();
      while ( $events->have_posts() ) : $events->the_post();
    ?>
      <h3>
        <a href="<?php the_permalink(); ?>">
          <?php echo get_the_title(); ?>
        </a>
      </h3>
    <?php
      endwhile;
      wp_reset_query();
    ?>
  </section>

  <section>
    <a href="">Spende jetzt!</a>
  </section>
</main>

<?php get_footer(); ?>
