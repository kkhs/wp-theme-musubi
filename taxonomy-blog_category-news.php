<?php
$upload_dir = wp_upload_dir();
get_header();
$post_type = get_query_var( 'post_type');
$tax = get_query_var( 'taxonomy');
$term = get_query_var( 'term');
$obj = get_post_type_object( $post_type );
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

if(!$term){
  $tax_query = array(
    'taxonomy' => 'blog_category',
    'field' => 'slug',
    'terms' => 'news',
    'operator' => 'NOT IN',
  );
}elseif($term !== 'news'){
  $tax_query = array(
    'taxonomy' => $tax,
    'field' => 'slug',
    'terms' => $term,
    'operator' => 'IN',
  );
}else{
  $tax_query = array(
    'taxonomy' => 'blog_category',
    'field' => 'slug',
    'terms' => 'news',
    'operator' => 'IN',
  );
}
$news = ($term === 'news')?1:0;
?>
<div id="content" class="<?php echo $post_type;
                         if($news)echo ' news'; ?> archive">
  <article class="article_main">
    <section id="entries">
      <h1 class="tit">
<?php if(term_exists($term, 'blog_category')){
  if($news){
    echo 'お知らせ一覧';
  }else{
  single_tag_title( '', true );
  }
}elseif(term_exists($term, 'blog_tag')){
  single_tag_title( '#', true );
}else{
  echo 'ブログ一覧';
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
  
if(!$news){
    
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
	<a href="<?php the_permalink() ?>">
    <span class="img new">
      <?php if ( has_post_thumbnail() ) : ?>
        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
      <?php else: ?>
      <img src="/assets/images/common/noimg.jpg" alt="">
      <?php endif; ?>
    </span>
    <span class="desc">
      <h2 class="tit"><?php the_title(); ?></h2>
      <span class="meta">
        <?php
        $terms = get_the_terms( $post->ID, 'blog_category' );
        if ( $terms && ! is_wp_error( $terms ) ) :
        ?>
        <ul class="category">
          <?php
            $tags = array();
            foreach ( $terms as $term ) {
          ?>
          <li class="tag"><span class="label"><?php echo $term->name; ?></span></li>
          <?php } ?>
        </ul>
        <span class="date">| <?php the_time('Y/n/j'); ?></span>
        <?php endif; ?>
      </span>
      <span class="more">read more</span>
    </span>
	</a>
</li>
<?php      
    }
  } endif;

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
  $query = new WP_Query( $args );

  if ( $query -> have_posts() ):
  while ( $query->have_posts() ) {
  $query->the_post();
  $entry = get_the_time('U');
  $postdate = date('U',($today - $entry)) / 86400 ;
  $new = ( $days > $postdate )?1:0;
    
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
      <span class="meta">
        <?php
        $terms = get_the_terms( $post->ID, 'blog_category' );
        if ( $terms && ! is_wp_error( $terms ) ) :
        ?>
        <ul class="category">
          <?php
            foreach ( $terms as $term ) {
          ?>
          <li class="tag"><span class="label"><?php echo $term->name; ?></span></li>
          <?php } ?>
        </ul>
        <span class="date">| <?php the_time('Y/n/j'); ?></span>
        <?php endif; ?>
      </span>
    </span>
	</a>
</li>
<?php } // end while
  endif;
}else{//お知らせ
  $args = array(
    'paged' => $paged,
    'post_type' => $post_type,
    'posts_per_page'=>10,
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'tax_query' => array($tax_query),
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
    <?php if(get_the_content() || get_field('cf_summary')){ ?>
      <a class="news_wrap" href="<?php the_permalink() ?>">
    <?php }elseif(get_field('cf_exlink')){ ?>
      <a class="news_wrap" href="<?php echo get_field('cf_exlink'); ?>" target="_blank">
    <?php }else{ ?>
      <div class="news_wrap">
    <?php } ?>
        <span class="date"><?php the_time('Y/n/j'); ?></span>
        <?php
        $terms = get_the_terms( $post->ID, 'blog_category' );
        if ( $terms && ! is_wp_error( $terms ) ) :
        ?>
        <span class="category">
          <?php
            foreach ( $terms as $term ) {
              if($term->slug != 'news'){
                echo $term->name;
                break;
              }
            } 
          ?>
        </span>
        <?php endif; ?>
        <h2 class="tit"><?php the_title(); ?></h2>
    <?php if(get_the_content()){ ?>
      </a>
    <?php }elseif(get_field('cf_exlink')){ ?>
      </a>
    <?php }else{ ?>
      </div>
    <?php } ?>
</li>
<?php } // end while
  endif;
  
  
  
}
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