<?php
$upload_dir = wp_upload_dir();
get_header();
?>

<div id="content" class="<?php echo $post_type; ?> single">
  <article class="article_main">
    <section id="entry" class="faq_entry">
      <?php
      if ( have_posts() ):
      ?>
<div class="post">
<?php
	while ( have_posts() ) {
	the_post();
?>
  <h1 class="post_tit center">よくある質問</h1>
    
  <?php if(get_the_content()): ?>
  <div class="post_content faq_post_content">
    <?php the_content(); ?>
  </div>
  <?php endif; ?>
  
  
<?php
$faq = get_field('cf_faq');
if(have_rows('cf_faq')):
?>
  <div class="faq_list">
    <ul>
<?php
while(have_rows('cf_faq')): the_row();
   $faq_li = get_sub_field('cf_faq_li');
?>
      <li>
        <h3 class="faq_q"><?php echo $faq_li['cf_faq_q']; ?></h3>
        <div class="faq_a">
          <?php echo '<div class="txt">'.$faq_li['cf_faq_a']['cf_faq_a_txt'].'</div>';
          if($faq_li['cf_faq_a']['cf_faq_a_link']){
            echo '<div class="link"><a href="'.$faq_li['cf_faq_a']['cf_faq_a_link']['url'].'" target="'.$faq_li['cf_faq_a']['cf_faq_a_link']['target'].'">'.$faq_li['cf_faq_a']['cf_faq_a_link']['title'].'</a></div>';
          }
          if($faq_li['cf_faq_a']['cf_faq_a_note']){
            echo '<div class="note">'.$faq_li['cf_faq_a']['cf_faq_a_note'].'</div>';
          }
          ?>
        </div>
      </li>
<?php
endwhile;
?>
    </ul>
  </div>
<?php
endif;
?>
  
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