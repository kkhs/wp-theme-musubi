<?php
$upload_dir = wp_upload_dir();
get_header();
?>

<?php if ( $post->post_parent ): // エントリー画面 ?>
  <div id="content" class="<?php echo $post_type; ?> single contact">
<!-- dataLayer -->
  <script>
    dataLayer.push({'eventname_form': 'eventname_form_<?php echo get_post($post->post_parent)->post_title; ?>'});
  </script>
<!-- dataLayer -->
  <article class="article_main">
  <section id="entry" class="contact_entry">
<?php if ( have_posts() ): ?>
  <div class="post">
<?php while ( have_posts() ) { the_post(); ?>
  <h1 class="post_tit center"><?php echo get_the_title(); ?></h1>
  <div class="post_wp_head">
    <div class="img new">
      <img src="<?php echo get_the_post_thumbnail_url($post->post_parent,'full'); ?>" alt="<?php echo get_post($post->post_parent)->post_title; ?>">
    </div>
    <div class="desc">
      <h2 class="post_tit"><?php echo get_the_title($post->post_parent); ?></h2>
      <input type="hidden" name="イベント" value="<?php echo get_the_title($post->post_parent); ?>">
      <span class="event_meta">
        <span class="event_date">開催日：<?php echo get_post_meta($post->post_parent, 'cf_overview_cf_date', true); ?></span>
        <span class="event_badges"></span>
      </span>
    </div>
  </div>

<?php if(get_the_content()): ?>
  <div class="post_content">
<?php the_content(); ?>
  </div>
<?php endif; } ?>
</div>

<?php else: ?>
  <div id="nopost">該当する投稿がありません。</div>
<?php endif; ?>
</section>
</article>
</div>

<?php else: // eventページ ?>
  <div id="content" class="<?php echo $post_type; ?> single">
  <article class="article_main">
  <section id="entry">
<?php if ( have_posts() ): ?>
  <div class="post">
<?php
  $overview = get_field('cf_overview');
  date_default_timezone_set('Asia/Tokyo'); $date_now = date('YmdHi');
  if($overview['cf_date_end'])$date_end = $overview['cf_date_end'];
  if( intval(get_field('cf_event_target')) === 1 || $date_now >= $date_end ):
?>
  <div class="badges">
    <?php if(intval(get_field('cf_event_target')) === 1){ ?><div class="post_badge">Musubiユーザ向け</div><?php } ?>
    <?php if($date_now >= $date_end){ ?><div class="event_end">開催終了</div><?php } ?>
  </div>
  <?php endif; ?>
<?php
	while ( have_posts() ) {
	the_post();
?>
  <h1 class="post_tit"><?php the_title(); ?></h1>

<?php
  $args = array(
    'nopaging' => true,
    'post_type' => 'event',
    'post_parent' => $post->ID,
  );
  $myposts = get_posts( $args );
  
  $has_entry = false;

  if( $myposts ) {
    foreach ( $myposts as $p1 ){
      if($p1->post_name == 'entry'){
        $has_entry = true;
      }
    }
  }
?>

  <div class="event_date">
    <div class="date">開催日時：<?php echo $overview['cf_date'] ?></div>
      <?php if($date_now < $date_end && get_field('cf_entry') && $has_entry){ ?>
      <a class="btn cta" href="/event/<?php echo $post->post_name; ?>/entry/">セミナーに参加する</a>
      <?php } ?>
  </div>
  <?php if(get_field('cf_user'))echo '<div class="post_user">'.get_field('cf_user').'</div>'; ?>
  <div class="post_img">
    <?php if ( has_post_thumbnail() ) : ?>
    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
    <?php else: ?>
    <img src="<?php echo_assets_root_url(); ?>assets/images/event/event_default.jpg" alt="">
    <?php endif; ?>
  </div>
  
  <div class="post_summary">
    <?php if(get_field('cf_summary'))echo '<p class="summary">'.get_field('cf_summary').'</p>'; ?>
    <div class="post_meta">
      <?php
      $tax = 'event_category';
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
      $tax = 'event_tag';
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
  
  <div class="post_content">
    <?php the_content(); ?>
    
    <?php
    $recommend = get_field('cf_recommend');
    if(have_rows('cf_recommend')):
    ?>
    <div class="event_recommend">
      <h3>こんな方におススメのセミナーです。</h3>
    <ul>
    <?php
    while(have_rows('cf_recommend')): the_row();
    echo '<li>'.get_sub_field('cf_recommend_li').'</li>';
    endwhile;
    ?>
    </ul>
    </div>
    <?php
    endif;
    ?>
    
    <h2>開催概要</h2>
    <div class="event_overview">
    <table>
    <?php if($overview['cf_date']): ?>
      <tr><th>開催日時</th><td><?php echo $overview['cf_date'].' '.$overview['cf_time']; ?></td></tr>
    <?php endif; ?>  
    <?php if($overview['cf_place']): ?>
      <tr>
        <th>会場</th>
        <td><?php
          echo $overview['cf_place'];
          if($overview['cf_map']){
            $map = $overview['cf_map'];
            if(strpos($map,'https://') !== false){
              $url = $map;
            }else{
              $url = 'http://maps.google.com/maps?q='.$map;
            }
            echo '</br><a href="'.$url.'" target="_blank">（地図を表示）</a>';
          } ?></td>
      </tr>
    <?php endif; ?>  
    <?php if($overview['cf_fee']): ?>
      <tr><th>受講料</th><td><?php echo $overview['cf_fee']; ?></td></tr>
    <?php endif; ?>  
    <?php if($overview['cf_program']): ?>
      <tr><th>プログラム</th><td><?php echo $overview['cf_program']; ?></td></tr>
    <?php endif; ?>  
    <?php if($overview['cf_sponsor']): ?>
      <tr><th>主催</th><td><?php echo $overview['cf_sponsor']; ?></td></tr>
    <?php endif; ?>  
    <?php if($overview['cf_inquiry']): ?>
      <tr><th>お問い合わせ</th><td><?php echo $overview['cf_inquiry']; ?></td></tr>
    <?php endif; ?>  
    <?php if($overview['cf_remarks']): ?>
      <tr><th>備考</th><td><?php echo $overview['cf_remarks']; ?></td></tr>
    <?php endif; ?>  
    </table>
    </div>
    
    <?php
    $recommend = get_field('cf_speaker');
    if(have_rows('cf_speaker')):
    ?>
    <h2>スピーカー</h2>
    <div class="event_speaker">
      <div class="speaker">
<?php while(have_rows('cf_speaker')): the_row();
    $sp_img = (get_sub_field('cf_speaker_img'))?get_sub_field('cf_speaker_img'):'/assets/images/event/speaker_img.jpg';
    echo '<div class="img" style="background-image:url('.$sp_img.');"><img src="'.$sp_img.'" alt="'.get_sub_field('cf_speaker_name').'"></div>';
?>
<div class="desc">
  <h3 class="name"><?php echo get_sub_field('cf_speaker_name'); ?></h3>
  <div class="prof"><?php echo get_sub_field('cf_speaker_prof'); ?></div>
</div>
<?php endwhile; ?>
      </div>
    </div>
    <?php
    endif;
    ?>
    
  </div>
  
  <?php if($date_now < $date_end && get_field('cf_entry') && $has_entry){ ?>
 <div class="post_button"><a href="/event/<?php echo $post->post_name; ?>/entry/" class="btn cta big">セミナーに参加する</a></div>
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
<?php endif; ?>


<?php get_footer(); ?>
</body>
</html> 
