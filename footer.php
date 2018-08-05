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
