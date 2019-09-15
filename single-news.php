<?php get_header(); ?>

<main class="main">
  <article class="news-entry">
    <div class="constraint">
      <h1 class="news-entry__title">
        <small class="news-entry__date">
          <?php the_date(); ?>
          <span class="visually-hidden">:</span>
        </small>
        <?php the_title(); ?>
      </h1>

      <figure class="figure">
        <?php the_post_thumbnail('news', [
          'class' => 'figure__image'
        ]); ?>

        <figcaption class="figure__caption">
          <?php the_post_thumbnail_caption(); ?>
        </figcaption>
      </figure>

      <div class="block-content richtext">
        <?php the_content(); ?>
      </div>
    </div>
  </article>
</main>

<?php get_footer(); ?>
