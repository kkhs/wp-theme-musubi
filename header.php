<?php 
global $unique;
$post_type = get_post_type_object(get_post_type());
$isLp = get_field('cf_isLp');
if (is_home()) {
	$canonical_url = get_bloginfo('url');
} elseif (is_tag()) {
	$canonical_url = get_tag_link(get_query_var('tag_id'));
} elseif (is_category()) {
	$canonical_url = get_category_link(get_query_var('cat'));
//} elseif (is_archive('seminar')) {
//	$canonical_url = get_post_type_archive_link('seminar');
} elseif (is_page() || is_single()) { 
	$canonical_url = get_permalink();
} elseif(is_404()) {
	$canonical_url =  get_bloginfo('url')."/404";
} else {
	//$canonical_url  = get_bloginfo('url');
	$canonical_url  = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}

$assets_root = get_assets_root_url();
$ogimg = $assets_root . 'assets/images/ogp.jpg';
if(is_home()){
$ogimg = $assets_root . 'assets/images/ogp_top.jpg';
}elseif(is_page('product')){
$ogimg = $assets_root . 'assets/images/ogp_products.jpg';
}elseif(is_singular()){
	if (has_post_thumbnail()){
		$image_id = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src( $image_id, 'full');
    $ogimg = $image[0];
	}elseif (catch_that_image()){
//		$urlCap = get_bloginfo('url');
//		$ogimg = str_replace($urlCap, '', catch_that_image());
//		$ogimg = $urlCap.$ogimg;
	}
}
//global $overrightOGImage;
//if(isset($overrightOGImage)){
//$ogimg = $overrightOGImage;
//}
?>
<!DOCTYPE html>
<html>
<?php if ( is_front_page() ) { ?>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
<?php }else{ ?>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<?php } ?>
	<meta charset="utf-8">
	
<?php //title
	global $ttlBefore;
	$addTitle = get_bloginfo('title');
	if ( is_front_page() ) { 
		$title = $addTitle; 
	}elseif( is_singular() ) {
    $post_type = get_post_type_object(get_post_type());
    global $post;
    if ( is_object_in_term($post->ID, 'blog_category','news') ){
      $title = the_title_attribute('echo=0').'｜お知らせ｜'.$addTitle; 
    }elseif( $post_type->name != 'post' && $post_type->name != 'page' ){
      $title = the_title_attribute('echo=0').'｜'.$post_type->label.'｜'.$addTitle; 
    }else{
      $title = the_title_attribute('echo=0').'｜'.$addTitle; 
    }
	}elseif( is_tag()) { 
		$title = "#".single_tag_title( '', false ).'｜'.$addTitle; 
	}elseif(is_tax() || is_category()) { 
		$title = single_tag_title( '', false ).'｜'.$addTitle; 
	}elseif( is_year() ) { 
		$title = get_the_time('Y年').'｜'.$addTitle; 
	}elseif( is_month() ) { 
		$title = get_the_time('Y年m月').'｜'.$addTitle; 
	}elseif(is_archive()) {
		$post_type = get_post_type_object(get_post_type());
		$title = $post_type->label.'｜'.$addTitle;
	}elseif( is_404() ) {
		$title = "指定されたページが見つかりませんでした。".'｜'.$addTitle; 
	}elseif( is_search() ) { 
		$title = "検索結果".'｜'.$addTitle; 
	}else{
    if($unique['title']){
		$title = $unique['title'].'｜'.$addTitle; 
    }else{
		$title = the_title_attribute('echo=0').'｜'.$addTitle; 
    }
	} ?>
	<title><?php echo $ttlBefore.$title;?></title>
		
	<link rel="shortcut icon" href="<?php echo_assets_root_url(); ?>assets/images/common/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo_assets_root_url(); ?>assets/images/common/apple-touch-icon.png">
	
	<?php $description = get_bloginfo('description'); ?>
	<meta name="description" content="<?php echo $description; ?>">
	<?php wp_head(); ?>
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	
	<meta property="og:title" content="<?php echo $ttlBefore.$title; ?>"/>
	<meta property="og:description" content="<?php echo $description; ?>"/>
	<meta property="og:url" content="<?php echo $canonical_url; ?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:site_name" content="<?php echo $ttlBefore.$title; ?>"/>
	<meta property="og:image" content="<?php echo $ogimg; ?>"/>

	<link rel="stylesheet" href="<?php echo_assets_root_url(); ?>assets/css/common.css">
  <?php if(is_archive()): ?>
	<link rel="stylesheet" href="<?php echo_assets_root_url(); ?>assets/css/archive.css">
  <?php elseif(is_page() || is_singular()): ?>
	<link rel="stylesheet" href="<?php echo_assets_root_url(); ?>assets/css/single.css">
  <?php elseif($unique['layout'] === 'single' || is_404()): ?>
	<link rel="stylesheet" href="<?php echo_assets_root_url(); ?>assets/css/single.css">
  <?php endif; ?>
  <!-- scroll-hint -->
  <link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css">
  <!-- magnific-popup-->
  <link rel="stylesheet" href="<?php echo_assets_root_url(); ?>assets/css/magnific-popup.css">
    
  <?php if(is_page() || is_singular()): ?>
  <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "BlogPosting",
    "mainEntityOfPage":{
      "@type":"WebPage",
      "@id":"<?php the_permalink(); ?>"
    },
    "headline":"<?php echo $ttlBefore.$title;?>",
    "image": [
      "<?php echo $ogimg; ?>"
    ],
    "datePublished": "<?php echo get_date_from_gmt(get_post_time('c', true), 'c');?>",
    "dateModified": "<?php echo get_date_from_gmt(get_post_modified_time('c', true), 'c');?>",
    "author": {
      "@type": "Organization",
      "name": "KAKEHASHI Inc."
    },
    "publisher": {
      "@type": "Organization",
      "name": "KAKEHASHI Inc.",
      "logo": {
        "@type": "ImageObject",
        "url": "<?php echo_assets_root_url(); ?>assets/images/common/logo_h.svg"
      }
    },
    "description": "<?php echo $description; ?>"
  }
  </script>
    <?php endif; ?>

<script>
  dataLayer = [];
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T353GVC');</script>
<!-- End Google Tag Manager -->    
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T353GVC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->		
<div class="contents_wrap">
<header id="header">
  <div class="header_wrap">
    <div class="header_inner">
      <?php $titTag = is_home() ? 'h1' : 'div'; ?>
      <<?php echo $titTag; ?> class="header_logo"><a href="/"><img src="<?php echo_assets_root_url(); ?>assets/images/common/logo_h.svg" alt="<?php bloginfo('name'); ?>"></a></<?php echo $titTag; ?>>
      <div class="header_navi">
        <div class="header_top">
          <a href="/contact" class="btn cta">資料請求・お問い合わせ</a>
          <a href="https://support.kakehashi.life" target="_blank" class="usersite">ユーザーサイト</a>
        </div>
        <div class="header_btm">
          <ul class="header_menu">
            <li><a href="/concept"<?php if(is_page('concept')): ?>class="current"<?php endif; ?>>薬局体験とは</a></li>
            <li><a href="/product"<?php if(is_page('product')): ?>class="current"<?php endif; ?>>サービス詳細</a></li>
            <li><a href="/#price">価格</a></li>
            <li><a href="/case"<?php if(is_post_type_archive('case')|is_singular('case'))echo 'class="current"'; ?>>導入事例</a></li>
            <li><a href="/faq"<?php if(is_page('faq'))echo 'class="current"'; ?>>よくある質問</a></li>
            <li><a href="/wp-download"<?php if(is_post_type_archive('wp-download')|is_singular('wp-download'))echo 'class="current"'; ?>>お役立ち資料</a></li>
            <li><a href="/event"<?php if(is_post_type_archive('event')|is_singular('event'))echo 'class="current"'; ?>>イベント</a></li>
            <li><a href="/blog"<?php if(is_post_type_archive('blog')|is_singular('blog'))echo 'class="current"'; ?>>ブログ</a></li>
          </ul>
        </div>
      </div>
      <a href="javascript:void(0);" class="btn_menu"><span></span></a>
    </div>
  </div>
</header>
	
<?php if(!is_home() && !is_404() && !$isLp){ ?>
<div id="breadclumb"><ul typeof="BreadcrumbList" vocab="http://schema.org/">
<?php echo_breadcrumb(); ?>
</ul></div>
<?php } ?>
