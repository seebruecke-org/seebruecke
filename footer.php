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

    <script
      async
      defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcge6nR-oLJWLJG_IdLPGvmBJUsx70mm0&callback=googleMaps">
    </script>

  </body>
</html>
