<?php
$upload_dir = wp_upload_dir();
get_header();
?>

<div id="content" class="<?php echo $post_type; ?> single">
  <article class="article_main">
    <section id="entry" class="contact_entry">
      <?php if ( have_posts() ):?>
        <div class="post">
          <?php while ( have_posts() ) { the_post();?>
            <h1 class="post_tit center">資料請求・お問い合わせ</h1>
          <?php if ( get_the_content() ):?>
            <div class="post_content">
            <div class="flow_area">
              <h2 class="title">お問い合わせ後の流れ</h2>
              <p class="caption">お問い合わせ内容を確認の上、<br class="display-sp">弊社からご連絡させて頂きます。</p>
              <div class="flow">
                <div class="box">
                  <span class="num">1</span>
                  <h3>お問い合わせ</h3>
                  <figure>
                    <img src="<?php echo_assets_root_url(); ?>assets/images/contact/img_contact_flow_1@2x.png" alt="流れ１">
                  </figure>
                  <p>まずは下記のフォームより、お気軽にご連絡ください。</p>
                </div>
                <div class="box">
                  <span class="num">2</span>
                  <h3>ご連絡・お打ち合わせ</h3>
                  <figure>
                    <img src="<?php echo_assets_root_url(); ?>assets/images/contact/img_contact_flow_2@2x.png" alt="流れ２">
                  </figure>
                  <p>適宜、お打ち合わせをご提案し、ヒアリングいたします。</p>
                </div>
                <div class="box">
                <span class="num">3</span>
                  <h3>デモ実演・商談</h3>
                  <figure>
                    <img src="<?php echo_assets_root_url(); ?>assets/images/contact/img_contact_flow_3@2x.png" alt="流れ３">
                  </figure>
                  <p>導入判断に必要な具体的な情報をご提供いたします。</p>
                </div>
                <div class="box">
                <span class="num">4</span>
                  <h3>ご契約</h3><span></span>
                  <figure>
                    <img src="<?php echo_assets_root_url(); ?>assets/images/contact/img_contact_flow_4@2x.png" alt="流れ４">
                  </figure>
                  <p>商談後、双方が合意の上でご契約いたします。</p>
                </div>
              </div>
            </div>
              <?php the_content();?>
            </div>
          <?php endif; } ?>
        </div>
      <?php else:?>
        <div id="nopost">
          該当する投稿がありません。
        </div>
      <?php endif;?>
    </section>
  </article>
</div>
<div class="copyright">Copyright &copy; 2017 KAKEHASHI Inc. All Rights Reserved.</div>
<script type="text/javascript" src="<?php echo_revisioned_assets_file_url('assets/js/navi.js'); ?>"></script>
</body>
</html>
