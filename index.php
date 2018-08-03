<?php get_header(); ?>

<main>
  <section>
    <h2>Wir bauen eine Brücke zu sicheren Häfen.</h2>
    <p>Menschen auf dem Mittelmeer sterben zu lassen, um die Abschottung Europas weiter voranzubringen und politische Machtkämpfe auszutragen, ist unerträglich und spricht gegen jegliche Humanität. Migration ist und war schon immer Teil unserer Gesellschaft! Statt dass die Grenzen dicht gemacht werden, brauchen wir ein offenes Europa, solidarische Städte, und sichere Häfen.</p>
    <p> Die SEEBRÜCKE ist eine internationale Bewegung, getragen von verschiedenen Bündnissen und Akteur*innen der Zivilgesellschaft. Wir solidarisieren uns mit allen Menschen auf der Flucht und fordern von der deutschen und europäischen Politik sichere Fluchtwege, eine Entkriminalisierung der Seenotrettung und eine menschenwürdige Aufnahme der Menschen, die fliehen mussten oder noch auf der Flucht sind.</p>
  </section>

  <section>
    <h2>Sei auch du Teil der Bewegung!</h2>

    <ol>
      <li>
        <h3>Bekenne Farbe!</h3>
        <p>Zeige die Farbe orange überall als Zeichen der grenzenlosen Solidarität mit Geflüchteten und der Seenotrettung. Trage ein orangefarbenes Tuch – als Halstuch, am Rucksack, um das Halsband deines Hundes, oder hänge eine orangene Fahne aus deinem Fenster. So ist für alle klar, dass du dich für sichere Fluchtwege und Seenotrettung stark machst.</p>
      </li>

      <li>
        <h3>Starte selbst eine Aktion!</h3>
        <p>Überzeuge deine Stadt, Gemeinde, oder dein Viertel, Menschen in Seenot aufzunehmen. Organisiere zum Beispiel eine Demo, einen Flashmob oder eine andere Aktion und sprich verantwortliche Politiker*innen an, geflüchtete Menschen bei euch aufzunehmen.</p>
        <p>Teile uns mit, wann und wo eure Demo oder Aktion stattfindet – zusammen sind wir stärker!</p>
      </li>

      <li>
        <h3>Erzähle allen davon!</h3>
        <p>Folge unseren Social-Media-Kanälen, berichte auf deinem Blog über die Bewegung und rege befreundete Journalist*innen an über die SEEBRÜCKE zu schreiben – alles auch gern international.</p>
    </ol>
  </section>

  <section>
    <h2>Nächste Aktionen</h2>
    <?php
      $events = get_all_events();
      while ( $events->have_posts() ) : $events->the_post();
    ?>
      <h3>
        <a href="<?php the_permalink(); ?>">
          <?php echo get_the_title(); ?>
        </a>
      </h3>
    <?php
      endwhile;
      wp_reset_query();
    ?>
  </section>

  <section>
    <a href="">Spende jetzt!</a>
  </section>
</main>

<?php get_footer(); ?>
