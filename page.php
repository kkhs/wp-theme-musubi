<?php
$upload_dir = wp_upload_dir();
get_header();
?>

<div id="content" class="<?php echo $post_type; ?> single">
  <article class="article_main">
    <section id="entry">
      <?php
      if ( have_posts() ):
      ?>
<div class="post">
<?php
	while ( have_posts() ) {
	the_post();
?>
  <h1 class="post_tit center"><?php the_title(); ?></h1>
  
  <?php if ( has_post_thumbnail() ) : ?>
  <div class="post_img">
    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
  </div>
  <?php endif; ?>
  
  <?php if ( get_field('cf_summary') ) : ?>
  <div class="post_summary page_summary">
    <?php if(get_field('cf_summary'))echo '<p class="summary">'.get_field('cf_summary').'</p>'; ?>
  </div>
  <?php endif; ?>
  
  <div class="post_content">
    <?php the_content(); ?>
  </div>
  
  <?php if(get_field('cf_btn_contact')){ ?>
  <div class="post_button"><a href="/contact" class="btn cta contact" target="_blank">詳細を問い合わせる</a></div>
  <?php } ?>
  
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