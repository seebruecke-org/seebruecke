<?php
  $footer = get_latest_footer();

  while ( $footer->have_posts() ) :
    $footer->the_post();
    $action = rwmb_meta('mailchimp_url');
    $enabled = rwmb_meta('mailchimp_enabled');

    if($enabled && $action) :
?>

  <section class="newsletter-subscribe">
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

          <div class="newsletter-subscribe__gdpr">
            <p>
              <?php echo pll__('Du kannst deine Meinung jederzeit ändern, indem du auf den Abbestellungs-Link klickst, den du in der Fußzeile jeder E-Mail, die du von uns erhältst, finden kannst, oder indem du uns unter action@seebruecke.org kontaktierst. Wir werden deine Daten mit Sorgfalt und Respekt behandeln. Weitere Informationen zu unseren Datenschutzpraktiken findest du auf unserer Website. Indem du unten auf "Für die Liste anmelden" klickst, erklärst du dich damit einverstanden, dass wir deine Daten in Übereinstimmung mit diesen Bedingungen verarbeiten dürfen.'); ?>
            </p>
            <p>
              <?php echo pll__('Wir verwenden MailChimp als unsere Marketing-Plattform. Wenn Sie unten auf "Abonnieren" klicken, bestätigen Sie, dass Ihre Daten zur Verarbeitung an MailChimp übertragen werden. Bitte klicken Sie <a href="https://mailchimp.com/legal/" rel="nofollow">hier</a>, um mehr über die Datenschutzpraktiken von MailChimp zu erfahren.'); ?>
            </p>
          </div>
        </div>
      </form>
    </div>
  </section>

<?php
    endif;
  endwhile;
?>
