<?php /* Template Name: Kampagne */ ?>

<?php
  global $post;

  $page_id = get_queried_object_id();
  $parents = get_post_ancestors($page_id);
  $has_parent = (bool)$parents;
  $campaign_id = end($parents);
  $header_id = rwmb_meta('page_header_reference', null, $has_parent ? $campaign_id : $page_id);

  if (!$header_id) {
    get_header('v2-single');
  } else {
    get_header('v2-hero');
  }

  function get_current_page_depth() {
    global $wp_query;

    $object = $wp_query->get_queried_object();
    $parent_id  = $object->post_parent;
    $depth = 0;
      while($parent_id > 0){
          $page = get_page($parent_id);
          $parent_id = $page->post_parent;
          $depth++;
      }

      return $depth;
  }
?>

<main class="v2-campaign">
  <div class="v2-campaign__inner-container">
    <article class="v2-campaign__content v2-richtext">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php if(get_current_page_depth() > 1) : ?>
          <h2>
            <?php the_title(); ?>
          </h2>
        <?php endif; ?>

        <?php the_content(); ?>
      <?php endwhile; ?>
    </article>
  </div>
</main>

<?php get_footer(); ?>
