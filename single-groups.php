<?php get_header(); ?>

<main class="main">
  <?php while ( have_posts() ) :
    the_post();
    $fields = get_post_custom();

  ?>
    <div class="constraint">
      <div class="action-single">
        <div class="action-single__meta-container">
          <div class="constraint">
            <h2 class="action-single__meta-title">
              <?php echo pll__('Nächste Aktion'); ?>
            </h2>

            <dl class="action-single__meta"></dl>
          </div>
        </div>
      </div>

      <article class="richtext">
        <?php the_content(); ?>
      </article>
    </div>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
