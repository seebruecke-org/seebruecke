<?php get_header('archive'); ?>

<main class="main">
  <?php /* render main page content */ ?>
  <?php while ( have_posts() ) :
    the_post();
    $fields = get_post_custom();
  ?>
    <div class="constraint">
      <ul class="archive-events">
        <li class="action">
          <h2 class="action__title">
            <div class="action__meta">
              <small class="action__date">
                <?php echo $fields['event_date'][0]; ?>
                <?php echo $fields['event_time'][0]; ?>
              </small>

              &middot;

              <small class="action__location">
                <?php echo $fields['event_location'][0]; ?>
              </small>
            </div>

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
