<?php
$upload_dir = wp_upload_dir();
get_header();
?>

<div id="content" class="<?php echo $post_type; ?> single">
  <article class="article_main">
    <section id="entry" class="event_entry">
<?php
if ( have_posts() ):
?>
<div class="post">
<?php
	while ( have_posts() ) {
    the_post();
?>
  <h1 class="post_tit center">イベント</h1>
<?php
    if(get_the_content()):
?>
  <div class="post_content">
<?php
      the_content();
?>
  </div>
<?php
    endif;
  }
?>
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

</body>
</html>
