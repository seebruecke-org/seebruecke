<?php
  $page_id = get_queried_object_id();
  $header_id = rwmb_meta('page_header_reference', null, $page_id);

  if (!$header_id) {
    get_header('v2-single');
  } else {
    get_header('v2-hero');
  }
?>

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
