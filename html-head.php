<?php
  $site_description = get_bloginfo('description');
  $site_name = get_bloginfo('name');
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
    <?php
      $post_type = get_post_type();
      $post_title = get_the_title();

      switch($post_type) {
        case 'page':
          if(is_front_page()) {
            echo $site_name;
          } else {
            echo $post_title . ' - ' . $site_name;
          }
          break;

        case 'safe-havens':
          echo 'Sicherer Hafen ' . $post_title . ' - Seebrücke';
          break;

        default:
          echo $post_title . ' - ' . $site_name;
      }
    ?>
  </title>

  <?php wp_head(); ?>
</head>
