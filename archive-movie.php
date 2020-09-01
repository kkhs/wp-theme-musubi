<?php
$upload_dir = wp_upload_dir();
get_header();
$post_type = get_query_var( 'post_type');
$tax = get_query_var( 'taxonomy');
$term = get_query_var( 'term');
$obj = get_post_type_object( $post_type );
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
?>
<!--<pre><?php var_dump( $wp_rewrite ); ?></pre>-->

<div id="content" class="<?php echo $post_type; ?> archive">
  <article class="article_main">
    <section id="entries">
      <h1 class="tit">
        <?php
if(term_exists($term, 'movie_tag')){
  single_tag_title( '#', true );
  $tax_query = array(
    'taxonomy' => 'movie_tag',
    'field' => 'slug',
    'terms' => $term,
    'operator' => 'IN',
  );
}elseif(term_exists($term, 'movie_category')){
  single_tag_title();
  $tax_query = array(
    'taxonomy' => 'movie_category',
    'field' => 'slug',
    'terms' => $term,
    'operator' => 'IN',
  );
}else{
  echo '動画ギャラリー';
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
      
  if ( !is_date() ) {
    $args = array(
      'paged' => $paged,
      'post_type' => $post_type,
      'post_parent' => 0,
      'posts_per_page'=>8,
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
      'post_parent' => 0,
      'posts_per_page'=>8,
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
  $overview = str_replace('\n', '', mb_substr(strip_tags(get_field('cf_summary')), 0, 60,'UTF-8')).'...';
  $seconds = get_field('cf_movieseconds');
  $limit = 1;
  $num = $query->current_post;
?>
<li class="post">
	<div class="post_box">
    <?php if ( !is_paged() && $limit > $num ) : ?>
      <a href="<?php the_permalink() ?>" class="img new">
    <?php else: ?>
      <a href="<?php the_permalink() ?>" class="img">
    <?php endif; ?>
      <?php if ( has_post_thumbnail() ) : ?>
        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
      <?php else: ?>
        <img src="<?php echo_assets_root_url(); ?>assets/images/event/event_default.jpg" alt="">
      <?php endif; ?>
      <span class="seconds"><?php echo $seconds; ?></span>
    </a>
    <span class="desc">
      <h2 class="tit"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
      <div class="overview">
        <?php echo $overview ; ?>
      </div>
      <?php //カテゴリ
      $tax = 'movie_category';
      $terms = get_the_terms( $post->ID, $tax );
      if ( $terms && ! is_wp_error( $terms ) ) :
      ?>
      <ul class="category">
        <?php
          foreach ( $terms as $term ) {
            echo '<li class="tag"><a href="'.get_term_link($term->slug, $tax).'" class="label">'.$term->name.'</a></li>';
          } ?>
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
            echo '<li class="tag"><a href="'.get_term_link($term->slug, $tax).'" class="label">#'.$term->name.'</a></li>';
          }
        ?>
      </ul>
      <?php endif; ?>
      <div class="movie_meta">
        <span class="date"><?php the_time('Y/n/j'); ?></span>
      </div>    
      <?php echo '</span>'; ?>
    </span>
	</div>
</li>
<?php } // end while
  endif;
?>

      </ul>
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
