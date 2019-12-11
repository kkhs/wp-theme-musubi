<?php
// アイキャッチ画像を有効にする。
add_theme_support('post-thumbnails');

// 記事の自動整形を無効化
//remove_filter('the_content', 'wpautop');

// 抜粋の自動整形を無効化
//remove_filter('the_excerpt', 'wpautop');

//ショートコードを追加
add_shortcode('url', 'shortcode_url');
function shortcode_url() {
return get_bloginfo('url');
}
add_shortcode('tdir', 'tmp_dir');
function tmp_dir() {
return get_template_directory_uri();
}
add_shortcode('cdir', 'child_dir');
function child_dir() {
return get_stylesheet_directory_uri();
}


// Gutenberg用のCSSを読み込む
if ( ! function_exists( 'custom_theme_setup' ) ) :
  function custom_theme_setup() {
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style-editor.css' );
  }
endif;
add_action( 'after_setup_theme', 'custom_theme_setup' );

?>