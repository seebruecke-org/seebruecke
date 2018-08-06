<?php get_header(); ?>

<main class="main">
  <?php while ( have_posts() ) :
    the_post();
    $fields = get_post_custom();
  ?>
    <div class="constraint">
      <div class="action-single">
        <article class="richtext">
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
                    <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"></path></svg>
                    <?php
                      echo date(get_date_format(), strtotime($fields['event_date'][0]));
                      echo '&nbsp;' . pll__('um') . '&nbsp;';
                      echo $fields['event_time'][0]; ?>
                  </dd>
                <?php endif; ?>

                <dt class="action-single__meta-term">
                  <span class="visually-hidden">
                    <?php echo pll__('Ort'); ?>
                  </span>
                </dt>

                <dd>
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 288 512"><path fill="currentColor" d="M112 316.94v156.69l22.02 33.02c4.75 7.12 15.22 7.12 19.97 0L176 473.63V316.94c-10.39 1.92-21.06 3.06-32 3.06s-21.61-1.14-32-3.06zM144 0C64.47 0 0 64.47 0 144s64.47 144 144 144 144-64.47 144-144S223.53 0 144 0zm0 76c-37.5 0-68 30.5-68 68 0 6.62-5.38 12-12 12s-12-5.38-12-12c0-50.73 41.28-92 92-92 6.62 0 12 5.38 12 12s-5.38 12-12 12z"></path></svg>
                  <?php echo $fields['event_location'][0]; ?>
                </dd>

                <?php if($fields['event_link']) : ?>
                  <dt class="action-single__meta-term">
                    <span class="visually-hidden">
                      <?php echo pll__('Link'); ?>
                    </span>
                  </dt>
                  <dd>
                    <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z"></path></svg>
                    <a href="<?php echo $fields['event_link'][0]; ?>" rel="nofollow">
                      <?php echo $fields['event_link'][0]; ?>
                    </a>
                  </dd>
                <?php endif; ?>
              </dl>
            </div>
          </div>

          <?php the_content(); ?>
        </article>
      </div>
    </div>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
