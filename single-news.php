<?php get_header('v2-single'); ?>

<main class="v2-main">
  <article class="news-entry">
    <div class="v2-constraint">
      <figure class="figure">
        <?php the_post_thumbnail('news', [
          'class' => 'figure__image'
        ]); ?>

        <figcaption class="figure__caption">
          <?php the_post_thumbnail_caption(); ?>
        </figcaption>
      </figure>

      <div class="block-content richtext">
        <?php the_excerpt(); ?>
        <?php the_content(); ?>
      </div>
    </div>
  </article>
</main>

<?php get_footer(); ?>
