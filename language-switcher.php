<ul class="language-switcher">
  <?php
    $languages = pll_the_languages( array( 'raw' => 1 ) );
    foreach($languages as $language):
  ?>
      <li class="language-switcher__item">
        <a href="<?php echo $language['url']; ?>"
          class="language-switcher__language">
          <?php echo $language['name']; ?>
        </a>
      </li>
  <?php
    endforeach;
  ?>
</ul>
