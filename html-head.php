<head>
  <meta charset="utf-8" />

  <meta http-equiv="x-ua-compatible"
        content="ie=edge" />

  <meta name="viewport"
        content="width=device-width, initial-scale=1" />

  <link rel="shortcut icon"
        type="image/png"
        href="<?php echo get_template_directory_uri(); ?>/dist/images/favicon.png"/>

  <link rel="shortcut icon"
        type="image/png"
        href="<?php echo get_template_directory_uri(); ?>/dist/images/favicon.png"/>

  <title>
    <?php wp_title(' - ', true, 'right'); ?>
    <?php bloginfo('name'); ?>
  </title>

  <?php wp_head(); ?>
</head>
