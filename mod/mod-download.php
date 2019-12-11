<?php
  if(is_single())$post__not_in = $post->ID;
  $args = array(
    'post_type' => 'post',
    'posts_per_page'=>3,
    'post__not_in' => array($post__not_in),
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
  );
  $query = new WP_Query( $args );
  if ( $query -> have_posts() ):
?>
<div id="mod-download">
  <div class="download_inner">
    <h2 class="tit">お役立ち資料が<br class="forSP">無料ダウンロードできます</h2>
    <div class="download_list">
      <ul>
<?php
  while ( $query->have_posts() ) {
  $query->the_post();    
?>
        <li>
          <div class="img">
            <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
            <?php else: ?>
            <img src="/assets/images/whitepaper/wp_noimg.jpg" alt="<?php the_title(); ?>">
            <?php endif; ?>
          </div>
          <div class="desc">
            <h3 class="tit"><?php the_title(); ?></h3>
            <a href="<?php the_permalink() ?>" class="btn">今すぐダウンロード</a>
          </div>
        </li>
<?php } // end while ?>
      </ul>
    </div>
    <?php /* ?>
    <div class="to_archive">
      <a href="/download">資料ダウンロード一覧へ</a>
    </div>
    <?php */ ?>
  </div>
</div>
<?php
  endif;
  wp_reset_query();
?>
