<?php
  $TITLE = '<small class="header__title-byline">Seebrücke Lokalgruppe </small>' . get_the_title();
  get_header();
?>

<main class="main">
  <?php while ( have_posts() ) :
    the_post();
    $fields = get_post_custom();
    $events_upcoming = get_all_upcoming_events_by_localgroup(get_the_ID());
    $next_event_upcoming = $events_upcoming->posts[0];
    $next_event_upcoming_fields = get_post_custom($next_event_upcoming->ID);
    $next_event_upcoming_link = get_permalink($next_event_upcoming->ID);

    $facebook_link = rwmb_meta('group_facebook');
    $twitter_link = rwmb_meta('group_twitter');
    $instagram_link = rwmb_meta('group_instagram');
    $youtube_link = rwmb_meta('group_youtube');
  ?>
    <div class="constraint">
      <?php if($next_event_upcoming) : ?>
        <div class="action-single">
          <div class="action-single__meta-container">
            <div class="constraint">
              <h2 class="action-single__meta-title">
                <?php echo pll__('Nächste Aktion'); ?>
              </h2>

              <dl class="action-single__meta">
                <?php if($next_event_upcoming_fields['event_date']) : ?>
                  <dt class="action-single__meta-term">
                    <span class="visually-hidden">
                      <?php echo pll__('Uhrzeit'); ?>
                    </span>
                  </dt>
                  <dd>
                    <p class="action-single__meta-value">
                      <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"></path></svg>

                      <?php
                        echo date(get_date_format(), strtotime($next_event_upcoming_fields['event_date'][0]));
                        echo '&nbsp;' . pll__('um') . '&nbsp;';
                        echo $next_event_upcoming_fields['event_time'][0];
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
                      $address = $next_event_upcoming_fields['event_city'][0];

                      if ($next_event_upcoming_fields['event_address'][0]) {
                        $address .= ', ' . $next_event_upcoming_fields['event_address'][0];
                      }

                      echo $address;
                    ?>
                  </p>
                </dd>

                <dt class="action-single__meta-term">
                  <span class="visually-hidden">
                    <?php echo pll__('Link'); ?>
                  </span>
                </dt>
                <dd>
                  <p class="action-single__meta-value">
                    <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z"></path></svg>

                    <a href="<?php echo $next_event_upcoming_link ?>" itemprop="url">
                      <?php echo $next_event_upcoming->post_title; ?>
                    </a>
                  </p>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div class="support">
      <div class="constraint">
        <em class="support__label">
          <?php echo pll__('Lokalgruppe'); ?> <?php the_title(); ?> <?php echo pll__('auf'); ?>
        </em>

        <?php if ($facebook_link) : ?>
          <a href="<?php echo $facebook_link; ?>" class="support__item">
            <span class="visually-hidden">facebook</span>
            <svg aria-hidden="true"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 264 512">
              <path fill="currentColor"
                    d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229">
              </path>
            </svg>
          </a>
        <?php endif; ?>

        <?php if ($twitter_link) : ?>
          <a href="<?php echo $twitter_link; ?>" class="support__item">
            <span class="visually-hidden">twitter</span>
            <svg aria-hidden="true"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
              <path fill="currentColor"
                    d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
              </path>
            </svg>
          </a>
        <?php endif; ?>

        <?php if ($instagram_link) : ?>
          <a href="<?php echo $instagram_link; ?>" class="support__item">
            <span class="visually-hidden">instagram</span>
            <svg aria-hidden="true"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512">
              <path fill="currentColor"
                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
              </path>
            </svg>
          </a>
        <?php endif; ?>

        <?php if ($youtube_link) : ?>
          <a class="support__item" href="<?php echo $youtube_link; ?>" >
            <span class="visually-hidden">youtube</span>
            <svg aria-hidden="true"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 576 512">
              <path fill="currentColor"
                    d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z">
              </path>
            </svg>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <div class="constraint">
      <article class="richtext richtext--single">
        <?php the_content(); ?>
      </article>
    </div>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
