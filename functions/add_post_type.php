<?php

//投稿タイプごとに表示件数を指定
function change_posts_per_page( $query ) {
  if ( is_admin() || !$query->is_main_query() )
    return;
  if ( $query->is_archive( 'wp-download' ) ) {
    $query->set( 'posts_per_page', 1 );
  }
  if ( $query->is_archive( 'case' ) ) {
    $query->set( 'posts_per_page', 1 );
  }
  if ( $query->is_archive( 'event' ) ) {
    $query->set( 'posts_per_page', 1 );
  }
  if ( $query->is_archive( 'blog' ) ) {
    $query->set( 'posts_per_page', 1 );
  }
}
add_action( 'pre_get_posts', 'change_posts_per_page' );

/*
function custom_post_labels( $labels ) {
	$labels->name = 'お役立ち資料'; // 投稿
	$labels->singular_name = 'お役立ち資料'; // 投稿
	$labels->menu_name = 'お役立ち資料'; // 投稿
	$labels->name_admin_bar = 'お役立ち資料'; // 投稿
	return $labels;
}
add_filter( 'post_type_labels_post', 'custom_post_labels' );

function post_has_archive( $args, $post_type ) {
    if ( 'post' == $post_type ) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'wp-download';
    }
    return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );
*/

function create_post_type() {
  /* お役立ち資料 */	
  register_post_type(
    'wp-download',
    array(
      'label' => '導入事例',
      'labels' => array(
        'name' => 'お役立ち資料ダウンロード',
        'singular_name' => 'お役立ち資料',
        'menu_name' => 'お役立ち資料',
        'name_admin_bar' => 'お役立ち資料',
      ),
      'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true,
      'hierarchical' => false,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
      ),
      'taxonomies' => array( 'wp_category', 'wp_tag'),
      'menu_position' => 5,
      'show_in_rest' => true,
    )
  );
  register_taxonomy(
    'wp_category',
    'wp-download',
    array(
      'hierarchical' => true,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'カテゴリー',
      'query_var' => true,
      'rewrite' => array('slug' => 'wp-download'),
      'show_in_rest' => true,
    )
  );  
  register_taxonomy(
    'wp_tag',
    'wp-download',
    array(
      'hierarchical' => false,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'タグ',
      'query_var' => true,
      'rewrite' => array('slug' => 'wp-download'),
      'show_in_rest' => true,
    )
  );

  /* 導入事例 */	
  register_post_type(
    'case',
    array(
      'label' => '導入事例',
      'labels' => array(
        'menu_name' => '導入事例',
        //'name' => '投稿',
      ),
      'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true,
      'hierarchical' => false,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
      ),
      'taxonomies' => array( 'case_tag'),
      'menu_position' => 5,
      'show_in_rest' => true,
    )
  );
  register_taxonomy(
    'case_tag',
    'case',
    array(
      'hierarchical' => false,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'タグ',
      'query_var' => true,
      'rewrite' => array('slug' => 'case'),
      'show_in_rest' => true,
    )
  );  
	
  /* イベント */
  register_post_type(
    'event',
    array(
      'label' => 'イベント',
      'labels' => array(
        'menu_name' => 'イベント',
        //'name' => '投稿',
      ),
      'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true,
      'hierarchical' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
        'page-attributes',
      ),
      'taxonomies' => array( 'event_category', 'event_tag'),
      'menu_position' => 5,
      'show_in_rest' => true,
    )
  );
  register_taxonomy(
    'event_category',
    'event',
    array(
      'hierarchical' => true,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'カテゴリー',
      'query_var' => true,
      'rewrite' => array('slug' => 'event'),
      'show_in_rest' => true,
    )
  );  
  register_taxonomy(
    'event_tag',
    'event',
    array(
      'hierarchical' => false,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'タグ',
      'query_var' => true,
      'rewrite' => array('slug' => 'event'),
      'show_in_rest' => true,
    )
  );
  
  /* ブログ */	
  register_post_type(
    'blog',
    array(
      'label' => 'ブログ',
      'labels' => array(
        'menu_name' => 'ブログ',
        //'name' => '投稿',
      ),
      'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true,
      'hierarchical' => false,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
      ),
      'taxonomies' => array( 'blog_category', 'blog_tag'),
      'menu_position' => 5,
      'show_in_rest' => true,
    )
  );
  register_taxonomy(
    'blog_category',
    'blog',
    array(
      'hierarchical' => true,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'カテゴリー',
      'query_var' => true,
      'rewrite' => array('slug' => 'blog'),
      'show_in_rest' => true,
    )
  );  
  register_taxonomy(
    'blog_tag', 
    'blog', 
    array(
      'hierarchical' => false,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'タグ',
      'query_var' => true,
      'rewrite' => array('slug' => 'blog'),
      'show_in_rest' => true,
    )
  );
  
  
}
add_action( 'init', 'create_post_type' );

//カスタム投稿パーマリンク「/taxonomy/」削除
function my_custom_post_type_permalinks_set($termlink, $term, $taxonomy){
    return str_replace('/'.$taxonomy.'/', '/', $termlink);
}
add_filter('term_link', 'my_custom_post_type_permalinks_set',11,3);

/*//カスタム分類アーカイブ用のリライトルールを追加
add_rewrite_rule('case/tag/([^/]+)/?$', 'index.php?case_tag=$matches[1]', 'top');
add_rewrite_rule('case/tag/([^/]+)/page/([0-9]+)/?$', 'index.php?case_tag=$matches[1]&paged=$matches[2]', 'top');

add_rewrite_rule('event/([^/]+)/?$', 'index.php?event_category=$matches[1]', 'top');
add_rewrite_rule('event/([^/]+)/page/([0-9]+)/?$', 'index.php?event_category=$matches[1]&paged=$matches[2]', 'top');

add_rewrite_rule('blog/([^/]+)/?$', 'index.php?blog_category=$matches[1]', 'top');
add_rewrite_rule('blog/([^/]+)/page/([0-9]+)/?$', 'index.php?blog_category=$matches[1]&paged=$matches[2]', 'top');
*/

//投稿のスラッグの初期値を日付(YYYYMMDD形式)にする
/*
function set_slug_date() {
    // 投稿以外(固定ページなど)の場合は適用しない
    if ( 'post' == get_post_type() || 'case' == get_post_type() || 'event' == get_post_type() || 'blog' == get_post_type() ) {
?>
    <script>
        jQuery(function($){ $('#post_name').val("<?php echo date_i18n('Ymd-His'); ?>"); });
    </script>
<?php
    }else{
			return;
		}
}
add_action( 'admin_head-post-new.php','set_slug_date' );
*/


add_filter('rewrite_rules_array','wp_insertMyRewriteRules');
add_filter('query_vars','wp_insertMyRewriteQueryVars');
add_filter('init','flushRules');
function flushRules(){
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
function wp_insertMyRewriteRules($rules)
{
    $newrules = array();
    $taxonomies = get_taxonomies();
    $taxonomies = array_slice($taxonomies,4,count($taxonomies)-1);
 
    foreach ( $taxonomies as $taxonomy ) :
 
    $args['taxonomy'] = $taxonomy;
    $args['hide_empty'] = false;
 
    $cats = get_categories( $args );
 
    foreach ( $cats as $k => $v ){
        $post_type = 'wp-download';
        $newrules[$post_type.'/'.$taxonomy.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules[$post_type.'/'.$v->category_nicename.'/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename;
        $newrules[$post_type.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules[$post_type.'/date/([0-9]{4})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]';
        $newrules[$post_type.'/date/([0-9]{4})([0-9]{1,2})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]&monthnum=$matches[2]';
        $newrules[$post_type.'/date/([0-9]{4})([0-9]{1,2})([0-9]{1,2})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]';
      
        $post_type = 'case';
        $newrules[$post_type.'/'.$taxonomy.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules[$post_type.'/'.$v->category_nicename.'/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename;
        $newrules[$post_type.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules[$post_type.'/date/([0-9]{4})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]';
        $newrules[$post_type.'/date/([0-9]{4})([0-9]{1,2})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]&monthnum=$matches[2]';
        $newrules[$post_type.'/date/([0-9]{4})([0-9]{1,2})([0-9]{1,2})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]';
      
        $post_type = 'event';
        $newrules[$post_type.'/'.$taxonomy.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules[$post_type.'/'.$v->category_nicename.'/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename;
        $newrules[$post_type.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules[$post_type.'/date/([0-9]{4})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]';
        $newrules[$post_type.'/date/([0-9]{4})([0-9]{1,2})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]&monthnum=$matches[2]';
        $newrules[$post_type.'/date/([0-9]{4})([0-9]{1,2})([0-9]{1,2})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]';
      
        $post_type = 'blog';
        $newrules[$post_type.'/'.$taxonomy.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules[$post_type.'/'.$v->category_nicename.'/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename;
        $newrules[$post_type.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type='.$post_type.'&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules[$post_type.'/date/([0-9]{4})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]';
        $newrules[$post_type.'/date/([0-9]{4})([0-9]{1,2})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]&monthnum=$matches[2]';
        $newrules[$post_type.'/date/([0-9]{4})([0-9]{1,2})([0-9]{1,2})/?$'] = 'index.php?post_type='.$post_type.'&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]';
            
    }
    $post_types = get_taxonomy($taxonomy)->object_type;
 
    foreach ($post_types as $post_type){
        //$newrules[$post_type.'/'.$taxonomy.'/(.+?)/?$'] = 'index.php?taxonomy='.$taxonomy.'&term='.$wp_rewrite->preg_index(1);
    }
    //$wp_rewrite->rules = array_merge($newrules, $wp_rewrite->rules);
 
    endforeach;
  
  
    return $newrules + $rules;
    
}


function wp_insertMyRewriteQueryVars($vars)
{
    array_push($vars, 'id');
    return $vars;
}

?>
