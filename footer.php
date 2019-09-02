<?php
  global $GOOGLE_MAPS_API_KEY;
?>

    <?php get_template_part('mailchimp', 'subscribe'); ?>

    <footer class="footer">
      <div class="constraint">
        <?php
          $footer = get_latest_footer();

          while ( $footer->have_posts() ) {
            $footer->the_post();
            the_content();
          }
        ?>
        <?php wp_footer(); ?>
      </div>
    </footer>
  </body>
</html>
