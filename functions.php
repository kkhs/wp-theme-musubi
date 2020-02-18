<?php

function get_assets_root_url() {
  return get_template_directory_uri() . '/';
}

function echo_assets_root_url() {
  echo get_assets_root_url();
}

/* header クリーニング */
// head内不要タグ削除
remove_action( 'wp_head', '_wp_render_title_tag', 1);
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'feed_links', 2);
remove_action( 'wp_head', 'feed_links_extra', 3);
remove_action( 'wp_head', 'noindex', 1 );
remove_action( 'wp_head', 'parent_post_rel_link',10);
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'start_post_rel_link',10);
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
//remove_action( 'wp_head', 'rel_canonical' );
add_editor_style( 'css/admin-editor.css' );

//リダイレクトループの回避
remove_filter('template_redirect', 'redirect_canonical');

// 管理画面ログイン画面 ロゴ変更
function my_login_logo() { ?>
<style type="text/css">
.login h1 a {
  background-image: url(/assets/images/common/logo_v.svg) !important;
  width: 100% !important;
  height: 130px !important;
  background-size: content !important;
}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//コメントを無効
add_filter( 'comments_open', '__return_false' );

//メニューを非表示
function unset_menu() {
  global $menu;
  //unset( $menu[ 5 ] ); //投稿メニュー
  unset( $menu[ 25 ] ); //コメント
}
add_action( "admin_menu", "unset_menu" );

// リンク先変更
function my_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

// タイトル変更
function my_login_logo_url_title() {
  return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function check_query_var() {
    $keys = array('attachment','attachment_id','author','author_name','cat','category_name',
        'comments_popup','day','error','feed','hour','hour','m','minute','monthnum',
        'name','p','page_id','paged','pagename','post_parent','post_type','preview',
        'second','static','subpost','subpost_id','tag','tag_id','tb','w','year','taxonomy','term','year','monthnum');
    foreach($keys as $key) {
        $query_var = get_query_var($key);
        if($query_var) {
            echo '<p>'.$key.': '.$query_var."</p>";
        }
    }
}

function echo_img_dir() {
  echo esc_url( wp_upload_dir()['baseurl']);
}

//固定ページの親ページをスラッグで判定する
//ex: if(is_parent_slug() === 'hoge')
function is_parent_slug() {
  global $post;
  if ($post->post_parent) {
    $post_data = get_post($post->post_parent);
    return $post_data->post_name;
  }
}
//固定ページのパーマリンクをスラッグで取得する
function get_permalink_byslug($slug){
	return esc_url(get_permalink(get_page_by_path($slug)));
}
//固定ページのステータスをスラッグで取得する
function get_status_byslug($slug){
	$id = get_page_by_path($slug)->ID;
	return get_post($id) -> post_status;
}

//一覧から1件目を判定
function isFirst(){
    global $wp_query;
    return ($wp_query->current_post === 0);
}

//記事本文の最初の画像を取得
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
//記事本文に画像がない場合
if(empty($first_img)){
        $first_img = get_assets_root_url() . 'assets/images/common/ogp.jpg';
    }
    return $first_img;
}


// 検索結果の並び順を日付順にする
add_filter('posts_search_orderby', 'custom_posts_search_orderby');
function custom_posts_search_orderby() {
	return ' post_date desc ';
}

function echo_first_image( $postID, $size = 'medium' ) {
  $args = array(
    'numberposts' => 1,
    'order' => 'ASC',
    'post_mime_type' => 'image',
    'post_parent' => $postID,
    'post_status' => null,
    'post_type' => 'attachment',
    'posts_per_page' => 1,
  );

  $attachments = get_children( $args );

  if ( $attachments ) {
    foreach ( $attachments as $attachment ) {
      $image_attributes = wp_get_attachment_image_src( $attachment->ID, $size )  ? wp_get_attachment_image_src( $attachment->ID, $size ) : wp_get_attachment_image_src( $attachment->ID, 'full' );
      //$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'full' );

      echo $image_attributes[0];
      //var_dump($image_attributes);
      break;
    }
  }
}

function my_scripts_method() {
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '1.11.2');
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

// the_archive_title 余計な文字を削除
function my_theme_archive_title( $title ) {
  if ( is_post_type_archive() && !is_date() ) {
    $title = post_type_archive_title( '', false );

  } elseif ( is_year() ) {
    $title = get_query_var('year').'年';

  } elseif ( is_date() ) {
    $date  = single_month_title('',false);
    $point = strpos($date,'月');
    $title = mb_substr($date,$point+1).'年'.mb_substr($date,0,$point+1);
  } elseif ( is_tax() ){
		$my_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		$title = $my_term->name;
	}

  return $title;
}

add_filter( 'get_the_archive_title', 'my_theme_archive_title' );


locate_template('functions/post_edit.php', true); 
locate_template('functions/echo_breadcrumb.php', true); 
locate_template('functions/add_post_type.php', true); 

?>
