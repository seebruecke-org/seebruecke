<?php
  $footer = get_latest_footer();

  while ( $footer->have_posts() ) :
    $footer->the_post();
    $action = rwmb_meta('mailchimp_url');
    $enabled = rwmb_meta('mailchimp_enabled');

    if($enabled && $action) :
?>

  <section class="newsletter-subscribe" id="newsletter">
    <div class="constraint">
      <form action="<?php echo $action; ?>" method="post" target="_blank" novalidate>

        <h4 class="newsletter-subscribe__title">
          <?php echo pll__('Newsletter abonnieren'); ?>
        </h4>

        <div class="newsletter-subscribe__intro">
          <p>
            <?php echo pll__('SEEBRÜCKE wird die Daten, die du in diesem Formular angibst, dazu verwenden, um mit dir in Kontakt zu bleiben und dir Updates und News zu unserer Arbeit zu schicken.'); ?>
          </p>
        </div>

        <input type="email"
              value=""
              name="EMAIL"
              placeholder="<?php echo pll__('Deine Email Adresse'); ?>"
              class="newsletter-subscribe__email"
              required />

        <div class="content__gdpr">
          <label class="newsletter-subscribe__checkbox">
            <input type="checkbox"
                  name="gdpr[20733]"
                  value="Y" />
            <span class="newsletter-subscribe__checkbox-label">
              <?php echo pll__('Ja, ich möchte per E-Mail informiert werden.'); ?>
            </span>
          </label>

          <div hidden>
            <input type="text"
                  name="b_f5e40f05f324bd3fd2785d2d8_5b9dfa6a11"
                  tabindex="-1"
                  value="" />
          </div>

          <input type="submit"
                value="<?php echo pll__('Abonnieren'); ?>"
                name="subscribe"
                class="newsletter-subscribe__submit" />
        </div>
      </form>
    </div>
  </section>

<?php
    endif;
  endwhile;
?>
