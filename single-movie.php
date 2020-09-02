<?php
$upload_dir = wp_upload_dir();
get_header();
?>


<?php // movieページ ?>
<div id="content" class="<?php echo $post_type; ?> single">
  <article class="article_main">
  <section id="entry">
<?php if ( have_posts() ): ?>
  <div class="post">
<?php
	while ( have_posts() ) {
	the_post();
?>
  <h1 class="post_tit"><?php the_title(); ?></h1>

<?php
  $args = array(
    'nopaging' => true,
    'post_type' => 'movie',
    'post_parent' => $post->ID,
  );
  $myposts = get_posts( $args );
  
  $has_entry = false;

  if( $myposts ) {
    foreach ( $myposts as $p1 ){
      if($p1->post_name == 'entry'){
        $has_entry = true;
      }
    }
  }
?>
  
  <div class="post_img">
    <?php if( get_field('cf_movie') ): ?>
      <div class="movie">
      <?php echo $embed_code = wp_oembed_get( get_field('cf_movie') ); ?>
      </div>
    <?php else: ?>
    <img src="<?php echo_assets_root_url(); ?>assets/images/event/event_default.jpg" alt="">
    <?php endif; ?>
  </div>
  
  <div class="post_summary">
    <?php if(get_field('cf_summary'))echo '<p class="summary">'.get_field('cf_summary').'</p>'; ?>
    <div class="post_meta">
      <?php
      $tax = 'movie_category';
      $terms = get_the_terms( $post->ID, $tax );
      if ( $terms && ! is_wp_error( $terms ) ) :
      ?>
      <ul class="category">
        <?php
          $tags = array();
          foreach ( $terms as $term ) {
            echo '<li class="tag"><a href="'.get_term_link($term->slug, $tax).'" class="label">'.$term->name.'</a></li>';
        } ?>
      </ul>
      <?php endif; ?>
      <?php
      $tax = 'movie_tag';
      $terms = get_the_terms( $post->ID, $tax );
      if ( $terms && ! is_wp_error( $terms ) ) :
      ?>
      <ul class="tags">
        <?php
          foreach ( $terms as $term ) {
            echo '<li class="tag"><a href="'.get_term_link($term->slug, $tax).'" class="label">#'.$term->name.'</a></li>';
          }
        ?>
      </ul>
      <span class="date"><?php the_time('Y/n/j'); ?></span>
      <?php endif; ?>

    </div>
  </div>
  
  <div class="post_content">
    <?php the_content(); ?>  
  </div>
  
<?php } // end while ?>
</div>

<?php
	else:
?>
  <div id="nopost">
    該当する投稿がありません。
  </div>
<?php
  endif;
?>
</section>

<?php
  $args = array(
    'post_type' => $post_type,
    'posts_per_page'=>3,
    'post__not_in' => array($post__not_in),
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'tax_query' => array($tax_query),
  );
  $query = new WP_Query( $args );
  if ( $query -> have_posts() ):
  $overview = get_field('cf_summary');
  $seconds = get_field('cf_movieseconds');
?>
<section id="relative">
  <h2 class="tit">そのほかの動画を見る</h2>
  <ul class="posts">
    <?php
      while ( $query->have_posts() ) {
      $query->the_post();    
    ?>
    <li class="post">
      <a href="<?php the_permalink() ?>">
        <span class="img">
          <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
          <?php else: ?>
          <img src="<?php echo_assets_root_url(); ?>assets/images/common/noimg.jpg" alt="">
          <?php endif; ?>
        </span>
        <span class="desc">
          <h2 class="tit"><?php the_title(); ?></h2>
          <span class="meta">

            <?php //カテゴリ
            $terms = get_the_terms( $post->ID, 'movie_category' );
            if ( $terms && ! is_wp_error( $terms ) ) :
            ?>
            <ul class="category">
              <?php
                foreach ( $terms as $term ) {
              ?>
              <li class="tag"><span class="label"><?php echo $term->name; ?></span></li>
              <?php } ?>
            </ul>
            <?php endif; ?>

            <?php //タグ
            $tax = 'movie_tag';
            $terms = get_the_terms( $post->ID, $tax );
            if ( $terms && ! is_wp_error( $terms ) ) :
            ?>
            <ul class="tags">
              <?php
                foreach ( $terms as $term ) {
                  echo '<li class="tag">#'.$term->name.'</li>';
                }
              ?>
            </ul>
            <?php endif; ?>
            
            <div class="movie_meta">
              <span class="date"><?php the_time('Y/n/j'); ?></span>
              <span class="seconds"><?php echo $seconds; ?></span>
            </div>   
          </span>
        </span>
      </a>
    </li>
    <?php } // end while
    ?>
  </ul>
</section>
<?php
  endif;
  wp_reset_query();
?>

</article>
</div>


<?php get_footer(); ?>
</body>
</html> 
