<?php $isLp = get_field('cf_isLp'); ?>

<?php if(!is_post_type_archive('wp-download')&& !is_singular('wp-download') && !$isLp){ include(TEMPLATEPATH .'/mod/mod-download.php');} ?>
<!-- ページ下部共通部分　非表示 -->
<?php // if(!$isLp) { include(TEMPLATEPATH .'/mod/mod-vision.php'); }?>
<?php if(!$isLp && !is_home() || !is_front_page()) { include(TEMPLATEPATH .'/mod/mod-commonunder.php'); }?>
<!-- LP用フッター　非表示 -->
<?php //if($isLp) { include(TEMPLATEPATH .'/mod/mod-inquiry.php'); }?>

<footer id="footer">
  <div class="ft_btm">
    <div class="ft_btm_navi">
      <dl>
        <dt>運営会社</dt>
        <dd><a href="https://www.kakehashi.life/" target="_blank">株式会社カケハシ</a></dd>
        <dd><a href="https://www.kakehashi.life/corporate.html" target="_blank">会社情報</a></dd>
        <dd><a href="https://www.kakehashi.life/recruit.html" target="_blank">採用情報</a></dd>
        <dd><a href="https://www.kakehashi.life/inquiry.html" target="_blank">お問い合わせ</a></dd>
      </dl>
    </div>
    <a href="https://support.kakehashi.life" target="_blank" class="usersite">ユーザーサイト</a>
  </div>
  <div class="copyright">Copyright &copy; 2017 KAKEHASHI Inc. All Rights Reserved.</div>
</footer>
</div><!--contents_wrap-->
<div id="floating">
  <div class="floating_bnr">
    <a href="tel:03-4405-1215" class="btn_tel">お電話はこちらから<br><span class="reception">受付時間 10:00～18:00（平日）</span>
    </a>
  </div>
</div>
<?php wp_footer(); ?>
<link rel="stylesheet" href="<?php echo_assets_root_url(); ?>assets/js/lib/simpleLightbox/simpleLightbox.min.css">
<link rel="stylesheet" href="<?php echo_revisioned_assets_file_url('assets/css/slick.css'); ?>">
<script type="text/javascript" src="<?php echo_assets_root_url(); ?>assets/js/lib/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo_assets_root_url(); ?>assets/js/lib/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo_assets_root_url(); ?>assets/js/lib/jquery.inview.min.js"></script>
<script type="text/javascript" src="<?php echo_assets_root_url(); ?>assets/js/lib/smooth-scroll.min.js"></script>
<script type="text/javascript" src="<?php echo_assets_root_url(); ?>assets/js/lib/simpleLightbox/simpleLightbox.min.js"></script>
<script type="text/javascript" src="<?php echo_assets_root_url(); ?>assets/js/lib/slick.min.js"></script>
<script type="text/javascript" src="<?php echo_revisioned_assets_file_url('assets/js/common.js'); ?>"></script>
<script src="https://unpkg.com/scroll-hint@1.1.10/js/scroll-hint.js"></script>
<?php 
/*if( current_user_can( 'administrator' ) ):
global $template; // テンプレートファイルのパスを取得
$temp_name = basename($template); // パスの最後の名前（ファイル名）を取得
echo '<div class="admin_info"><p>template: '.$temp_name.'</p>'; // ファイル名の表示
?>
<div class="check_query_var"><?php check_query_var(); ?></div>
<?php
echo '</div>';
endif;*/ ?>

