<?php
$upload_dir = wp_upload_dir();
get_header();
$post_type = get_query_var( 'post_type');
$tax = get_query_var( 'taxonomy');
$term = get_query_var( 'term');
$obj = get_post_type_object( $post_type );
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
?>

<div id="content" class="<?php echo $post_type; ?> archive">
  <style>
#content.archive.<?php echo $post_type; ?> #entries>.tit:before {
  content: "";
  display: block;
  width: 1.33333em;
  height: 1.13333em;
  background-image: url(<?php echo get_assets_root_url(); ?>assets/images/icons/icon_blog.svg);
}
  </style>
  <article class="article_main">
    <section id="entries">
      <h1 class="tit">
        <?php
if(term_exists($term, 'wp_tag')){
  single_tag_title( '#', true );
  $tax_query = array(
    'taxonomy' => 'wp_tag',
    'field' => 'slug',
    'terms' => $term,
    'operator' => 'IN',
  );
}elseif(term_exists($term, 'wp_category')){
  single_tag_title();
  $tax_query = array(
    'taxonomy' => 'wp_category',
    'field' => 'slug',
    'terms' => $term,
    'operator' => 'IN',
  );
}else{
  echo 'お役立ち資料ダウンロード';
  $tax_query = "";
} ?>
      </h1>
<ul class="posts">
<?php
  $monthly_arc = array(
    'year' => get_query_var( 'year' ),
    'monthnum' => get_query_var( 'monthnum' )
  );
  $paged = get_query_var( 'paged', 1 );
  $post__not_in = [];
  $days = 7;
  $today = date_i18n('U');
  date_default_timezone_set('Asia/Tokyo'); 
  $date_now = date('YmdHi');
  // Set back to UTC.
  date_default_timezone_set('UTC');
      
$first_args = array(
  'post_type' => $post_type,
  'posts_per_page'=>1,
  'post_status' => 'publish',
  'order' => 'DESC',
  'orderby' => 'date',
  'tax_query' => array($tax_query),
);
  $first_query = new WP_Query( $first_args );
  if ( $first_query -> have_posts() ):
  while ( $first_query->have_posts() ) {
  $first_query->the_post();
    $post__not_in = $post->ID;
    if (!is_paged()) {
      $entry = get_the_time('U');
      $postdate = date('U',($today - $entry)) / 86400 ;
      //$new = ( $days > $postdate )?1:0;
?>
<li class="post first">
	<div class="post_box">
    <?php if ( has_post_thumbnail() ) :
      $imgURL = get_the_post_thumbnail_url();
    else: 
      $imgURL = get_assets_root_url().'assets/images/common/noimg.jpg';
    endif;
    ?>
    <a href="<?php the_permalink() ?>" class="img" style="background: url(<?php echo $imgURL; ?>) 50% top/cover no-repeat;">
    <img style="opacity: 0;" src="<?php echo get_assets_root_url(); ?>assets/images/common/noimg.jpg" alt="">
    </a>
    <span class="desc">
      <h2 class="tit"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
      <?php
      echo '<span class="event_meta">';
      $tax = 'wp_category';
      $terms = get_the_terms( $post->ID, $tax );
      if ( $terms && ! is_wp_error( $terms ) ) :
      ?>
      <ul class="tags">
        <?php
          foreach ( $terms as $term ) {
            echo '<li class="tag"><a href="'.get_term_link($term->slug, $tax).'" class="label">'.$term->name.'</a></li>';
          } ?>
      </ul>
      <?php endif; ?>        
      <?php
      $tax = 'wp_tag';
      $terms = get_the_terms( $post->ID, $tax );
      if ( $terms && ! is_wp_error( $terms ) ) :
      ?>
      <ul class="tags">
        <?php
          foreach ( $terms as $term ) {
            echo '<li class="tag"><a href="'.get_term_link($term->slug, $tax).'" class="label">#'.$term->name.'</a></li>';
          } ?>
      </ul>
      <?php endif; ?>        
      <?php echo '</span>'; ?>
      <a href="<?php the_permalink() ?>" class="more">read more</a>
    </span>
	</div>
</li>
<?php      
    }
  } endif;
  
  if ( !is_date() ) {
    $args = array(
      'paged' => $paged,
      'post_type' => $post_type,
      'posts_per_page'=>9,
      'post__not_in' => array($post__not_in),
      'post_status' => 'publish',
      'order' => 'DESC',
      'orderby' => 'date',
      'tax_query' => array($tax_query),
    );
  } else {
    $args = array(
      'paged' => $paged,
      'post_type' => $post_type,
      'posts_per_page'=>9,
      'post__not_in' => array($post__not_in),
      'year' => $monthly_arc[ 'year' ],
      'monthnum' => $monthly_arc[ 'monthnum' ],
      'post_status' => 'publish',
      'order' => 'DESC',
      'orderby' => 'date',
    );
  }
  $query = new WP_Query( $args );

  if ( $query -> have_posts() ):
  while ( $query->have_posts() ) {
  $query->the_post();
  $entry = get_the_time('U');
  $postdate = date('U',($today - $entry)) / 86400 ;
  $new = ( $days > $postdate )?1:0;
?>
<li class="post">
    <div class="post_box">
    <?php if ( has_post_thumbnail() ) :
      $imgURL = get_the_post_thumbnail_url();
    else: 
      $imgURL = '/assets/images/common/noimg.jpg';
    endif;
    ?>
    <a href="<?php the_permalink() ?>" class="img" style="background: url(<?php echo $imgURL; ?>) 50% top/cover no-repeat;">
    <img style="opacity: 0;" src="<?php echo get_assets_root_url(); ?>assets/images/common/noimg.jpg" alt="">
    </a>
    <span class="desc">
      <h2 class="tit"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
      <?php
      echo '<span class="event_meta">';
      $tax = 'wp_category';
      $terms = get_the_terms( $post->ID, $tax );
      if ( $terms && ! is_wp_error( $terms ) ) :
      ?>
      <ul class="tags">
        <?php
          foreach ( $terms as $term ) {
            echo '<li class="tag"><a href="'.get_term_link($term->slug, $tax).'" class="label">'.$term->name.'</a></li>';
          } ?>
      </ul>
      <?php endif; ?>        
      <?php
      $tax = 'wp_tag';
      $terms = get_the_terms( $post->ID, $tax );
      if ( $terms && ! is_wp_error( $terms ) ) :
      ?>
      <ul class="tags">
        <?php
          foreach ( $terms as $term ) {
            echo '<li class="tag"><a href="'.get_term_link($term->slug, $tax).'" class="label">#'.$term->name.'</a></li>';
          } ?>
      </ul>
      <?php endif; ?>        
      <?php echo '</span>'; ?>
    </span>
	</div>
</li>
<?php } // end while
  endif;
  //wp_reset_query();
?>
      </ul>
      <!-- 1117スプリント時から非表示　問題なければ次回スプリント時に削除
      <div class="post_button"><a href="/download/" class="btn cta">無料で一括ダウンロードする</a></div>
      -->
    </section>
  </article>


  <?php 
    $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
    $args = array (
      'prev_next' => true,
      'prev_text' => '',
      'next_text' => '',
      'show_all'  => false,
      'end_size'  => 1,
      'mid_size'  => 2,
      'type'      => 'list',
    );
    the_posts_pagination($args);
  ?>

</div>
<?php get_footer(); ?>
</body>
</html>
