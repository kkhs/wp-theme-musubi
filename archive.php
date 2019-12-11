<?php
$upload_dir = wp_upload_dir();
get_header();
?>
archive.php
<?php if( current_user_can( 'administrator' ) ): ?>
<?php 
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$type = ( get_query_var('post_type') );
?><pre><?php
check_query_var();
?></pre>
<?php endif; ?>

<?php	if ( have_posts() ): ?>
<ul class="entries">
<?php
	while ( have_posts() ) {
	the_post();
?>
<li class="post">
	<a href="<?php the_permalink() ?>">
		<span class="date"><?php the_time('Y/m/d') ?></span>
		<h3 class="tit"><?php the_title(); ?></h3>
	</a>
</li>
<?php } // end while ?>
</ul>

<?php
	else:
?>
  <div id="nopost">
    該当する投稿がありません。
  </div>
<?php
  endif;
  //wp_reset_query();
?>

<div class="pagination">
<?php 
  $GLOBALS['wp_query']->max_num_pages;
  $args = array (
    'prev_text' => '',
    'next_text' => '',
    'show_all'  => false,
    'mid_size'  => 1,
    'type'      => 'list',
    //'base' => get_pagenum_link(1) . '%_%',
    //'format' => '?page=%#%',
  );
  the_posts_pagination($args);
 ?>
</div>



<?php get_footer(); ?>