<?php
$upload_dir = wp_upload_dir();
get_header();
?>

<div id="content" class="<?php echo $post_type; ?> single">
  <article class="article_main">
    <section id="entry">
<?php
      $post__not_in = [];
      if ( have_posts() ): ?>
<div class="post">
  <div class="badges"><div class="post_badge">Musubi導入事例</div></div>
<?php
	while ( have_posts() ) {
	the_post();
  $post__not_in = $post->ID;
?>
  <h1 class="post_tit"><?php the_title(); ?></h1>
  <?php if(get_field('cf_user'))echo '<div class="post_user">'.get_field('cf_user').'</div>'; ?>
  <div class="post_img">
    <?php if ( has_post_thumbnail() ) : ?>
    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
    <?php else: ?>
    <img src="/assets/images/common/noimg.jpg" alt="">
    <?php endif; ?>
  </div>
  
  <div class="post_summary">
    <?php if(get_field('cf_summary'))echo '<p class="summary">'.get_field('cf_summary').'</p>'; ?>
    <div class="post_meta">
      <div class="date">公開日：<?php the_time('Y/n/j'); ?></div>
      <?php
      $tax = 'case_tag';
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
      <?php endif; ?>      
    </div>
  </div>
  
  <div class="post_content">
    <?php the_content(); ?>
  </div>
  
  <div class="mod_date">更新日：<?php the_modified_date('Y/n/j'); ?></div>
  
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
  );
  $query = new WP_Query( $args );
  if ( $query -> have_posts() ):
?>
    <section id="relative">
      <h2 class="tit">そのほかの事例を読む</h2>
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
      <img src="/assets/images/common/noimg.jpg" alt="">
      <?php endif; ?>
    </span>
    <span class="desc">
      <h2 class="tit"><?php the_title(); ?></h2>
      <?php if(get_field('cf_user'))echo '<span class="meta">'.get_field('cf_user').'</span>'; ?>
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