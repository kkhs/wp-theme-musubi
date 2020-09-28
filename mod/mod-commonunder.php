<div id="mod-cu">
  <?php if( !is_post_type_archive('case') && !is_singular('case') ) : ?>
  <section id="case">
  <?php if( !is_page('concept') ) {echo '<div class="bg">';} ?>
    <div class="section_inner">
      <h2 class="title">導入事例</h2>
      <?php
      $args = array(
        'post_type' => 'case',
        'posts_per_page' => 6,
        'post_status' => 'publish',
        'order' => 'DESC',
        'orderby' => 'date',
      );
      $query = new WP_Query($args);
      if ($query->have_posts()) :
      ?>
        <div class="cases slider">
          <?php
          while ($query->have_posts()) {
            $query->the_post();
          ?>
            <div class="case">
              <a href="<?php the_permalink() ?>" class="case_inner">
                <span class="img">
                  <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                  <?php else : ?>
                    <img src="/assets/images/common/noimg.jpg" alt="">
                  <?php endif; ?>
                </span>
                <span class="desc">
                  <h2 class="tit"><?php the_title(); ?></h2>
                  <?php if (get_field('cf_user')) echo '<span class="user">' . get_field('cf_user') . '</span>'; ?>
                </span>
              </a>
            </div>
          <?php } // end while
          ?>
        </div>
        <script>
          $(document).ready(function() {
            $('.slider').slick({
              slide: '.case',
              infinite: true,
              slidesToShow: 3,
              slidesToScroll: 3,
              dots: true,
              prevArrow: '<a href="javascript:void(0)" class="slick-arrow slick-prev" title="Prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42.49 72.71"><polygon class="cls-1" style="fill: #999;" points="42.49 35.33 5.11 0 0 5.41 31.98 35.62 1.76 67.6 7.17 72.71 37.38 40.73 37.38 40.73 42.49 35.33"/></svg></a>',
              nextArrow: '<a href="javascript:void(0)" class="slick-arrow slick-next" title="Next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42.49 72.71"><polygon class="cls-1" style="fill: #999;" points="42.49 35.33 5.11 0 0 5.41 31.98 35.62 1.76 67.6 7.17 72.71 37.38 40.73 37.38 40.73 42.49 35.33"/></svg></a>',
              responsive: [{
                breakpoint: 960,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
              }]
            });
          });
        </script>
        <div class="btn_area">
          <a href="/case" class="btn cta">導入事例をもっと見る</a>
        </div>
      <?php
      endif;
      wp_reset_query();
      ?>
    </div>
    <?php if( !is_page('concept') ) {echo '</div>';} ?>
  </section>
  <?php endif; ?>

  <?php if(!is_post_type_archive('event')&& !is_singular('event')) : ?>
  <section id="event_custom">
    <?php if( !is_page('concept') ) {echo '<div class="bg">';} ?>
    <div class="section_inner">
      <h2 class="tit">イベント・セミナー情報</h2>
      <?php
      $args = array(
        'post_type' => 'event',
        'post_parent' => 0,
        'posts_per_page' => 8,
        'post_status' => 'publish',
        'order' => 'DESC',
        'orderby' => 'date',
      );
      $query = new WP_Query($args);
      if ($query->have_posts()) :
      ?>
        <div class="cases slider">
            <?php
              while ($query->have_posts()) {
                $query->the_post();
                $overview = get_field('cf_overview');
                if ($overview['cf_date_end']) $date_end = $overview['cf_date_end'];
              ?>
            <div class="case">
              <a class="post_wrap" href="<?php the_permalink() ?>">
                <span class="img">
                  <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                  <?php else : ?>
                    <img src="/assets/images/common/noimg.jpg" alt="">
                  <?php endif; ?>
                </span>
                <div class="inner">
                  <p class="tit"><?php the_title(); ?></p>
                  <div class="date">
                    <?php
                      $before = array('年', '月', '日');
                      $after = array('/', '/', '');
                      $date = str_replace($before, $after, $overview['cf_date']);
                      echo $date;
                      ?>
                  </div>
                  <?php
                  $terms = get_the_terms($post->ID, 'event_category');
                  if ($terms && !is_wp_error($terms)) :
                    foreach ($terms as $term) {
                  ?>
                      <span class="category"><?php echo $term->name; ?></span>
                  <?php }
                  endif; ?>
                </div>
              </a>
            </div>
          <?php } // end while
          ?>
        </div>
        <script>
          $(document).ready(function() {
            $('.slider').slick({
              slide: '.case',
              infinite: true,
              slidesToShow: 3,
              slidesToScroll: 3,
              dots: true,
              prevArrow: '<a href="javascript:void(0)" class="slick-arrow slick-prev" title="Prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42.49 72.71"><polygon class="cls-1" style="fill: #999;" points="42.49 35.33 5.11 0 0 5.41 31.98 35.62 1.76 67.6 7.17 72.71 37.38 40.73 37.38 40.73 42.49 35.33"/></svg></a>',
              nextArrow: '<a href="javascript:void(0)" class="slick-arrow slick-next" title="Next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42.49 72.71"><polygon class="cls-1" style="fill: #999;" points="42.49 35.33 5.11 0 0 5.41 31.98 35.62 1.76 67.6 7.17 72.71 37.38 40.73 37.38 40.73 42.49 35.33"/></svg></a>',
              responsive: [{
                breakpoint: 960,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
              }]
            });
          });
        </script>
        <div class="btn_area">
          <a href="/event" class="btn cta">イベント・セミナー情報をもっと見る</a>
        </div>
      <?php
      endif;
      wp_reset_query();
      ?>
    </div>
    <?php if( !is_page('concept') ) {echo '</div>';} ?>
  </section>
  <?php endif; ?>

  <?php if(!is_post_type_archive('wp-download')&& !is_singular('wp-download')) : ?>
  <section id="doc_custom">
    <?php if( is_page('concept') ) {echo '<div class="bg">';} ?>
      <div class="section_inner">
      <h2>お役立ち資料</h2>
        <?php
        $args = array(
          'post_type' => 'wp-download',
          'posts_per_page' => 6,
          'post_status' => 'publish',
          'order' => 'DESC',
          'orderby' => 'date',
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
        ?>
          <div class="cases slider">
            <?php
            while ($query->have_posts()) {
              $query->the_post();
            ?>
              <div class="case">
                <a href="<?php the_permalink() ?>" class="case_inner">
                  <span class="img">
                    <?php if (has_post_thumbnail()) : ?>
                      <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                    <?php else : ?>
                      <img src="/assets/images/common/noimg.jpg" alt="">
                    <?php endif; ?>
                  </span>
                  <span class="desc">
                    <h2 class="tit"><?php the_title(); ?></h2>
                    <?php if (get_field('cf_user')) echo '<span class="user">' . get_field('cf_user') . '</span>'; ?>
                  </span>
                </a>
              </div>
            <?php } // end while
            ?>
          </div>
          <script>
            $(document).ready(function() {
              $('.slider').slick({
                slide: '.case',
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                dots: true,
                prevArrow: '<a href="javascript:void(0)" class="slick-arrow slick-prev" title="Prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42.49 72.71"><polygon class="cls-1" style="fill: #999;" points="42.49 35.33 5.11 0 0 5.41 31.98 35.62 1.76 67.6 7.17 72.71 37.38 40.73 37.38 40.73 42.49 35.33"/></svg></a>',
                nextArrow: '<a href="javascript:void(0)" class="slick-arrow slick-next" title="Next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42.49 72.71"><polygon class="cls-1" style="fill: #999;" points="42.49 35.33 5.11 0 0 5.41 31.98 35.62 1.76 67.6 7.17 72.71 37.38 40.73 37.38 40.73 42.49 35.33"/></svg></a>',
                responsive: [{
                  breakpoint: 960,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                  }
                }]
              });
            });
          </script>
          <div class="btn_area">
            <a href="/wp-download" class="btn cta">お役立ち資料をもっと見る</a>
          </div>
        <?php
        endif;
        wp_reset_query();
        ?>
      </div>
    <?php if( is_page('concept') ) {echo '</div>';} ?>
  </section>
  <?php endif; ?>

  <section id="docarea_custom">
    <div class="bg">
      <h2>Musubiのことがよくわかる資料</h2>
      <div class="section_inner">
        <div class="doc-area">
          <figure>
          <img src="<?php echo_assets_root_url(); ?>assets/images/common/img_doc_1.png" alt="">
          </figure>
          <figure>
          <img src="<?php echo_assets_root_url(); ?>assets/images/common/img_doc_2.png" alt="">
          </figure>
          <figure>
          <img src="<?php echo_assets_root_url(); ?>assets/images/common/img_doc_3.png" alt="">
          </figure>
          <figure>
          <img src="<?php echo_assets_root_url(); ?>assets/images/common/img_doc_4.png" alt="">
          </figure>
        </div>
      </div>
      <div class="btn_area">
          <a href="/contact" class="btn cta">資料をダウンロードする</a>
      </div>
    </div>
  </section>  
</div>