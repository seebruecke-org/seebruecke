<?php get_header('v2-single'); ?>

<?php
$fields = get_post_custom();
?>

<main class="v2-main">
  <article class="v2-block-content">
    <?php if($fields['event_organizer'][0]) : ?>
      <?php
        $group_id = $fields['event_organizer'][0];
        $group = get_post($group_id);
        $group_link = get_permalink($group_id);
      ?>

      <p>
        Organisiert von der
        <a href="<?php echo $group_link; ?>">
          Lokalgruppe <?php echo $group->post_title; ?>
        </a>
      </p>
    <?php endif; ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; endif; ?>

    <div class="back">
      <?php
        $slug = pll_current_language('slug');
        $slug = $slug == 'de' ? '' : ('/' . $slug);
        $url = $slug . '/events/';
      ?>

      <?php if($fields['event_link']) : ?>
        <a href="<?php echo $fields['event_link'][0]; ?>" class="back__link">
          <?php echo $fields['event_link'][0]; ?>
        </a>
      <?php endif; ?>
    </div>
  </article>
</main>

<?php get_footer(); ?>
