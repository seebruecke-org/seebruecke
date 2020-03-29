<?php
  get_header('v2-single');
?>

<main class="main">
  <div class="constraint">
    <div class="richtext">
      <?php echo do_shortcode('[localgroups]'); ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>
