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
#content.archive.post #entries>.tit:before {
  content: "";
  display: block;
  width: 1.33333em;
  height: 1.13333em;
  background-image: url(<?php echo_assets_root_url(); ?>assets/images/icons/icon_blog.svg);
}
  </style>
  <article class="article_main">
    <section id="entries">
      <h1 class="tit">お役立ち資料ダウンロード</h1>
<ul class="posts">
<?php
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
    <?php if ( has_post_thumbnail() ) :
      $imgURL = get_the_post_thumbnail_url();
    else: 
      $imgURL = '/assets/images/common/noimg.jpg';
    endif;
    ?>
    <a href="<?php the_permalink() ?>" class="img" style="background: url(<?php echo $imgURL; ?>) 50% top/cover no-repeat;">
    <img style="opacity: 0;" src="<?php echo_assets_root_url(); ?>assets/images/common/noimg.jpg" alt="">
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
  } endif;  $args = array(
    'paged' => $paged,
    'post_type' => $post_type,
    'posts_per_page'=>9,
    'post__not_in' => array($post__not_in),
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
  );
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
    <img style="opacity: 0;" src="<?php echo_assets_root_url(); ?>assets/images/common/noimg.jpg" alt="">
    </a>
    <span class="desc">
      <h2 class="tit"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
      <span class="meta">
        <?php
      $tax = 'blog_category';
      $terms = get_the_terms( $post->ID, $tax );
      if ( $terms && ! is_wp_error( $terms ) ) :
        ?>
        <ul class="category">
        <?php
          foreach ( $terms as $term ) {
            echo '<li class="tag"><a href="'.get_term_link($term->slug, $tax).'" class="label">'.$term->name.'</a></li>';
          } ?>
        </ul>
        <span class="date">| <?php the_time('Y/n/j'); ?></span>
        <?php endif; ?>
      </span>
    </span>
	</div>
</li>
<?php } // end while
	else:
?>
  <div id="nopost">
    該当する投稿がありません。
  </div>
<?php
  endif;
  //wp_reset_query();
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
