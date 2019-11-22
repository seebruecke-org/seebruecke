<div class="language-switcher">
  <p class="language-switcher__label">
    <?php if (function_exists('pll__')) : ?>
      <?php echo pll__('Sprache:'); ?>
    <?php endif; ?>
  </p>

  <ul class="language-switcher__languages">
    <?php
      if (function_exists('pll_the_languages')) {
      foreach(pll_the_languages( array( 'raw' => 1 ) ) as $language):
        $is_current_lang = $language['current_lang'];
    ?>
        <li class="language-switcher__item">
          <a href="<?php echo $language['url']; ?>"
            class="language-switcher__language <?php if ($is_current_lang) { echo 'language-switcher__language--is-active'; } ?>">
            <?php echo $language['name']; ?>
          </a>
        </li>
    <?php
      endforeach;
    }
    ?>
  </ul>
</div>
