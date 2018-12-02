<?php get_header(); ?>

<main class="main">
  <?php while ( have_posts() ) :
    the_post();
    $fields = get_post_custom();
    $press = rwmb_meta('haven_press');
  ?>
    <div class="constraint">
      <div class="action-single">
        <article class="richtext richtext--single">
          <?php the_content(); ?>

          <?php if($press) : ?>
            <h2>Presse</h2>

            <ul>
              <?php

                foreach ($press as $pair) :
              ?>
                  <li>
                    <a href="<?php echo $pair[0]; ?>">
                        <?php echo $pair[1]; ?>
                    </a>
                  </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <div class="back">
            <?php
              $slug = pll_current_language('slug');
              $slug = $slug == 'de' ? '' : ('/' . $slug);
              $url = $slug . '/safe-havens/';
            ?>

            <a href="<?php echo $url; ?>" class="back__link">
              <svg aria-hidden="true" class="back__icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>
              <?php echo pll__('Alle safe havens'); ?>
            </a>
          </div>
        </article>
      </div>
    </div>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
