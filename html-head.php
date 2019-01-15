<?php
  $site_description = get_bloginfo('description');
?>

<head>
  <meta charset="utf-8" />

  <meta http-equiv="x-ua-compatible"
        content="ie=edge" />

  <meta name="viewport"
        content="width=device-width, initial-scale=1" />

  <meta name="google-site-verification"
        content="GDcufxtgT9spcsNJitT3rgxFisa4Ky-2MmplVI3u2wY" />

  <meta name="description"
        content="<?php echo $site_description; ?>">

  <link rel="shortcut icon"
        type="image/png"
        href="<?php echo get_template_directory_uri(); ?>/dist/images/favicon.png"/>

  <title>
    <?php wp_title(' - ', true, 'right'); ?>
    <?php bloginfo('name'); ?>
  </title>

  <?php wp_head(); ?>
</head>
