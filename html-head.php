<head>
  <meta charset="utf-8" />

  <script type="text/javascript">
    var html = document.querySelector('html');
    var removeJSClass = function(el) {
      el.classList.remove('no-js');
    }

    if (html) {
      removeJSClass(html);
    }
  </script>

  <meta http-equiv="x-ua-compatible"
        content="ie=edge" />

  <meta name="viewport"
        content="width=device-width, initial-scale=1" />

  <title>
    <?php wp_title(' - ', true, 'right'); ?>
    <?php bloginfo('name'); ?>
  </title>

  <link rel="shortcut icon"
        href="<?php bloginfo('template_directory'); ?>/favicon.ico" />

  <?php wp_head(); ?>
</head>
