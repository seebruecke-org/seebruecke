<li>
  <a href="<?php echo get_the_permalink($post['ID']); ?>" class="news-item">
    <figure class="news-item__thumbnail">
      <?php echo get_the_post_thumbnail($post['ID'], 'news-item', [
        'class' => 'news-item__thumbnail-image'
      ]); ?>
    </figure>

    <div class="news-item__content">
      <h3 class="news-item__title">
        <small class="news-item__published">
          <?php echo get_the_date(null, $post['ID']); ?>
        </small>
        <span class="news-item__title-text">
          <?php echo $post['post_title']; ?>
        </span>
      </h3>
      <div class="news-item__excerpt">
        <?php the_excerpt(); ?>
      </div>
    </div>
  </a>
</li>
