<?php /* Template Name: V2 Page */ ?>

<?php
  $page_id = get_queried_object_id();
  $header_id = rwmb_meta('page_header_reference', null, $page_id);

  if (!$header_id) {
    get_header('v2-single');
  } else {
    get_header('v2-hero');
  }
?>

<main class="v2-main">
  <article class="v2-block-content">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </article>
</main>

<?php get_footer(); ?>
