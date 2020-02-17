<?php
$upload_dir = wp_upload_dir();
get_header();
?>

<div id="content" class="<?php echo $post_type; ?> single">
  <article class="article_main">
    <section id="entry" class="post_entry">
<?php
      $post__not_in = [];
      if ( have_posts() ): ?>
<div class="post">
<?php
	while ( have_posts() ) {
	the_post();
  $post__not_in = $post->ID;
?>
  <div class="post_wp_head">
    <div class="img">
      <?php if ( has_post_thumbnail() ) : ?>
      <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
      <?php else: ?>
      <img src="<?php echo get_assets_root_url(); ?>assets/images/whitepaper/wp_noimg.jpg" alt="<?php the_title(); ?>">
      <?php endif; ?>
    </div>
    <div class="desc">
      <h1 class="post_tit">「<?php the_title(); ?>」<span class="after">無料ダウンロード</span></h1>
      <div class="meta">
        <div class="date"><?php the_time('Y/n/j'); ?></div>
      </div>
      <a href="/download/?id=<?php echo $post->ID; ?>" class="btn cta" target="_blank">無料ダウンロードする</a>
    </div>
  </div>
  
  <div class="post_summary">
    <?php if(get_field('cf_summary'))echo '<p class="summary">'.get_field('cf_summary').'</p>'; ?>
    <div class="post_meta">
      <?php
      $tax = 'wp_category';
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
      $tax = 'wp_tag';
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
  
  <div class="post_wp_body">
    <div class="post_content">
      <?php the_content(); ?>

      <?php
      $recommend = get_field('cf_index');
      if(have_rows('cf_index')):
      ?>
      <div class="post_index">
        <h3>目次</h3>
      <ul>
      <?php
      while(have_rows('cf_index')): the_row();
      echo '<li>'.get_sub_field('cf_index_li').'</li>';
      endwhile;
      ?>
      </ul>
      </div>
      <?php
      endif;
      ?>    
    </div>

    <div class="post_button"><a href="/download/?id=<?php echo $post->ID; ?>" class="btn cta" target="_blank">無料ダウンロードする</a></div>
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
  </article>

</div>

<?php get_footer(); ?>
</body>
</html>
