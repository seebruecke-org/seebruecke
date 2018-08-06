<?php get_header(); ?>

<main class="main">
  <div class="constraint">
    <article class="richtext">
      <p>
        <?php echo pll__('Diese Seite wurde nicht gefunden ...'); ?></p>
      <p>
        <a href="<?php echo pll_home_url(); ?>">
          <?php echo pll__('Zurück zur Startseite'); ?>
        </a>
      </p>
    </article>
  </div>
</main>

<?php get_footer(); ?>
