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
          if(term_exists($term, 'case_tag')){
            single_tag_title( '#', true );
            $tax_query = array(
              'taxonomy' => 'case_tag',
              'field' => 'slug',
              'terms' => $term,
              'operator' => 'IN',
            );
          }else{
            echo '導入事例一覧';
          }
        ?>
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
    <a class="img new"  href="<?php the_permalink() ?>">
      <?php if ( has_post_thumbnail() ) : ?>
        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
      <?php else: ?>
      <img src="/assets/images/common/noimg.jpg" alt="">
      <?php endif; ?>
    </a>
    <span class="desc">
      <h2 class="tit"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
      <?php if(get_field('cf_user'))echo '<span class="user">'.get_field('cf_user').'</span>'; ?>
      <span class="meta">
        <?php
        $tax = 'case_tag';
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
      </span>      
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
    <a href="<?php the_permalink() ?>" class="img">
      <?php if ( has_post_thumbnail() ) : ?>
        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
      <?php else: ?>
      <img src="/assets/images/common/noimg.jpg" alt="">
      <?php endif; ?>
    </a>
    <span class="desc">
      <h2 class="tit"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
      <?php if(get_field('cf_user'))echo '<span class="meta">'.get_field('cf_user').'</span>'; ?>
      <?php
      $tax = 'case_tag';
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