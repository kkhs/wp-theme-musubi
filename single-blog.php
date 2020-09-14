<?php
$upload_dir = wp_upload_dir();
get_header();
?>

<div id="content" class="<?php echo $post_type; ?> single <?php if(is_object_in_term($post->ID, 'blog_category','news'))echo 'news' ;?>">
  <article class="article_main">
    <section id="entry">
      <?php
      $post__not_in = [];
      if ( have_posts() ):
      
      $terms = get_the_terms( $post->ID, 'blog_category' );
      if ( $terms && ! is_wp_error( $terms ) ) :
      foreach ( $terms as $term ) {
        if($term->slug != 'news'){
          $term_name = $term->name;
          break;
        }
      } 
      endif;
      ?>
      
      <div class="post_outer <?php if(is_object_in_term($post->ID, 'blog_category','news'))echo 'news' ;?>">
        <div class="post">
          <div class="badges">
            <?php if(is_object_in_term($post->ID, 'blog_category','news')){ ?>
              <div class="post_badge"><?php echo $term_name; ?></div><div class="date"><?php the_time('Y/n/j'); ?></div>
            <?php }else{ ?>
              <div class="post_badge"><?php echo 'Musubiブログ'; ?></div>
            <?php } ?>
          </div>
          <?php
            while ( have_posts() ) {
            the_post();
            $post__not_in = $post->ID;
          ?>
          <h1 class="post_tit"><?php the_title(); ?></h1>
          <div class="post_img">
            <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
            <?php /*else: ?>
            <img src="/assets/images/common/noimg.jpg" alt="">
            <?php */endif; ?>
          </div>
          
          <?php if(!is_object_in_term($post->ID, 'blog_category','news')){ ?>
          <div class="post_summary">
            <?php if(get_field('cf_summary'))echo '<p class="summary">'.get_field('cf_summary').'</p>'; ?>
            <div class="post_meta">
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
              <?php endif; ?>
              <div class="date">
                <?php if ( $terms && ! is_wp_error( $terms ) )echo '| ';
                the_time('Y/n/j'); ?></div>
              <?php
              $tax = 'blog_tag';
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
          <?php }else{
            $tax = 'blog_tag';
            $terms = get_the_terms( $post->ID, $tax );
            if ( $terms && ! is_wp_error( $terms ) || get_field('cf_summary') ) :
          ?>
          <div class="post_summary">
            <?php if(get_field('cf_summary'))echo '<p class="summary">'.get_field('cf_summary').'</p>'; ?>
            <div class="post_meta">
              <ul class="tags">
                <?php
                  foreach ( $terms as $term ) {
                    echo '<li class="tag"><a href="'.get_term_link($term->slug, $tax).'" class="label">#'.$term->name.'</a></li>';
                  }
                ?>
              </ul>
            </div>
          </div>
          <?php endif;
            }
          ?>
          
          <div class="post_content">
            <?php the_content(); ?>
          </div>
          
          <?php if(get_field('cf_exlink')){ ?>
          <div class="post_button"><a href="<?php echo get_field('cf_exlink'); ?>" class="btn cta" target="_blank">掲載ページを見る</a></div>
          <?php } ?>
          
          <?php if(get_field('cf_pdf')){ ?>
          <div class="post_button"><a href="<?php echo get_field('cf_pdf'); ?>" class="btn cta" target="_blank">PDFダウンロードはこちら</a></div>
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
        <!-- sidebar（PC） -->
        <div class="sidebar_outer display-pc">
        <?php include('sidebar.php'); ?>
        </div>
        <!--// sidebar（PC） -->
      </div><!--// post_outer -->
    </section>

    <?php
      if(!is_object_in_term($post->ID, 'blog_category','news')){

      $tax_query = array(
        'taxonomy' => 'blog_category',
        'field' => 'slug',
        'terms' => 'news',
        'operator' => 'NOT IN',
      );
      $args = array(
        'post_type' => $post_type,
        'posts_per_page'=>3,
        'post__not_in' => array($post__not_in),
        'post_status' => 'publish',
        'order' => 'DESC',
        'orderby' => 'date',
        'tax_query' => array($tax_query),
      );
      $query = new WP_Query( $args );
      if ( $query -> have_posts() ):
    ?>
    <section id="relative">
      <h2 class="tit">そのほかのブログを読む</h2>
      <ul class="posts">
        <?php
          while ( $query->have_posts() ) {
          $query->the_post();    
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
        ?>
      </ul>
    </section>
    
    <!-- sidebar（SP） -->
    <div class="display-sp">
      <section id="entry">
        <div class="post_outer">
            <div class="sidebar_outer">
            <?php include('sidebar.php'); ?>
            </div>
        </div>
      </section>
    </div>
    <!--// sidebar（SP） -->
      
    <?php
      endif;
      wp_reset_query();
      }
    ?>
  </article>
</div>

<?php get_footer(); ?>
</body>
</html>
