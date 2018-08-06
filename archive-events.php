<?php get_header('archive'); ?>

<main class="main">
  <div class="constraint">
    <div class="actions">
      <ul class="actions__list">
        <?php while ( have_posts() ) :
          the_post();
          $fields = get_post_custom();
        ?>
          <li class="actions__action">
            <div class="action">
              <h2 class="action__title">
                <div class="action__meta">
                  <small class="action__date">
                    <?php echo date(get_date_format(), strtotime($fields['event_date'][0])); ?>,&nbsp;<?php echo $fields['event_time'][0]; ?>
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
            </div>
          </li>
        <?php endwhile; ?>
      </ul>
    </div>
  </div>
</main>

<?php get_footer(); ?>
