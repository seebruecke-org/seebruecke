<?php get_header(); ?>

<main class="main" itemscope itemtype="http://schema.org/Event">
  <?php while ( have_posts() ) :
    the_post();
    $fields = get_post_custom();
  ?>
    <div class="constraint">
      <div class="action-single">
        <div class="action-single__meta-container">
          <div class="constraint">
            <dl class="action-single__meta">
              <?php if($fields['event_date']) : ?>
                <dt class="action-single__meta-term">
                  <span class="visually-hidden">
                    <?php echo pll__('Uhrzeit'); ?>
                  </span>
                </dt>
                <dd>
                  <p class="action-single__meta-value">
                    <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"></path></svg>

                    <?php
                      echo date(get_date_format(), strtotime($fields['event_date'][0]));
                      echo '&nbsp;' . pll__('um') . '&nbsp;';
                      echo $fields['event_time'][0];
                    ?>
                  </p>
                </dd>
              <?php endif; ?>

              <dt class="action-single__meta-term">
                <span class="visually-hidden">
                  <?php echo pll__('Ort'); ?>
                </span>
              </dt>

              <dd>
                <p class="action-single__meta-value">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 288 512"><path fill="currentColor" d="M112 316.94v156.69l22.02 33.02c4.75 7.12 15.22 7.12 19.97 0L176 473.63V316.94c-10.39 1.92-21.06 3.06-32 3.06s-21.61-1.14-32-3.06zM144 0C64.47 0 0 64.47 0 144s64.47 144 144 144 144-64.47 144-144S223.53 0 144 0zm0 76c-37.5 0-68 30.5-68 68 0 6.62-5.38 12-12 12s-12-5.38-12-12c0-50.73 41.28-92 92-92 6.62 0 12 5.38 12 12s-5.38 12-12 12z"></path></svg>

                  <?php
                    $address = $fields['event_city'][0];

                    if ($fields['event_address'][0]) {
                      $address .= ', ' . $fields['event_address'][0];
                    }

                    echo $address;
                  ?>
                </p>
              </dd>

              <?php if($fields['event_link']) : ?>
                <dt class="action-single__meta-term">
                  <span class="visually-hidden">
                    <?php echo pll__('Link'); ?>
                  </span>
                </dt>
                <dd>
                  <p class="action-single__meta-value">
                    <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z"></path></svg>

                    <a href="<?php echo $fields['event_link'][0]; ?>" rel="nofollow" itemprop="url">
                      <?php echo pll__('Link zum Event'); ?>
                    </a>
                  </p>
                </dd>
              <?php endif; ?>

              <?php if($fields['event_organizer']) : ?>
                <dt class="action-single__meta-term">
                  <span class="visually-hidden">
                    <?php echo pll__('Lokalgruppe'); ?>
                  </span>
                </dt>
                <dd>
                  <p class="action-single__meta-value">
                    <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"></path></svg>

                    <?php
                      $group_id = $fields['event_organizer'][0];
                      $group = get_post($group_id);
                      $group_link = get_permalink($group_id);
                    ?>

                    <?php echo pll__('Lokalgruppe'); ?>

                    <a href="<?php echo $group_link; ?>" rel="nofollow" itemprop="url">
                      <?php echo $group->post_title; ?>
                    </a>
                  </p>
                </dd>
              <?php endif; ?>
            </dl>
          </div>
        </div>

        <article class="richtext">
          <?php the_content(); ?>

          <div class="back">
            <?php
              $slug = pll_current_language('slug');
              $slug = $slug == 'de' ? '' : ('/' . $slug);
              $url = $slug . '/events/';
            ?>

            <a href="<?php echo $url; ?>" class="back__link">
              <svg aria-hidden="true" class="back__icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>
              <?php echo pll__('Alle Aktionen'); ?>
            </a>
          </div>
        </article>
      </div>
    </div>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
