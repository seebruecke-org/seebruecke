<li>
  <figure class="news-item__thumbnail">
    <?php the_post_thumbnail('news-item', [
      'class' => 'news-item__image'
    ]); ?>
  </figure>

  <div class="news-item__content">
    <h3 class="news-item__title"><?php the_title(); ?></h3>
    <div class="news-item__excerpt"><?php the_excerpt(); ?></div>
  </div>
</li>
