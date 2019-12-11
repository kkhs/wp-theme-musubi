<?php
function custom_post_labels( $labels ) {
	$labels->name = 'ホワイトペーパー'; // 投稿
	$labels->singular_name = 'ホワイトペーパー'; // 投稿
	$labels->menu_name = 'ホワイトペーパー'; // 投稿
	$labels->name_admin_bar = 'ホワイトペーパー'; // 投稿
	return $labels;
}
add_filter( 'post_type_labels_post', 'custom_post_labels' );


function create_post_type() {
  /* 導入事例 */	
  register_post_type(
    'case',
    array(
      'label' => '導入事例',
      'labels' => array(
        'menu_name' => '導入事例',
        'name' => '投稿',
      ),
      'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true,
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
        'name' => '投稿',
      ),
      'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
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
        'name' => '投稿',
      ),
      'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
      ),
      'taxonomies' => array( 'blog_category', 'blog_tag'),
      'menu_position' => 5,
      'show_in_rest' => true,
      'rewrite' => array(
          'slug' => 'blog_category',
          'with_front' => false,
          'hierarchical' => true
      )      
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

//投稿のスラッグの初期値を日付(YYYYMMDD形式)にする
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

/* パーマリンクを拡張 */
//add_action( 'generate_rewrite_rules', 'my_rewrite' );
//function my_rewrite( $wp_rewrite ){
//    $taxonomies = get_taxonomies();
//    $taxonomies = array_slice($taxonomies,4,count($taxonomies)-1);
// 
//    foreach ( $taxonomies as $taxonomy ) :
// 
//    $args['taxonomy'] = $taxonomy;
//    $args['hide_empty'] = false;
// 
//    $cats = get_categories( $args );
// 
//    foreach ( $cats as $k => $v ){
//        $new_rules['case/'.$taxonomy.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=case&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
//        $new_rules['case/'.$v->category_nicename.'/?$'] = 'index.php?post_type=case&taxonomy='.$taxonomy.'&term='.$v->category_nicename;
//        $new_rules['case/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=case&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
//      
//        $new_rules['event/'.$taxonomy.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=event&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
//        $new_rules['event/'.$v->category_nicename.'/?$'] = 'index.php?post_type=event&taxonomy='.$taxonomy.'&term='.$v->category_nicename;
//        $new_rules['event/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=event&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
//      
//        $new_rules['blog/'.$taxonomy.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=blog&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
//        $new_rules['blog/'.$v->category_nicename.'/?$'] = 'index.php?post_type=blog&taxonomy='.$taxonomy.'&term='.$v->category_nicename;
//        $new_rules['blog/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=blog&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
//    }
//    $post_types = get_taxonomy($taxonomy)->object_type;
// 
//    foreach ($post_types as $post_type){
//        $new_rules[$post_type.'/'.$taxonomy.'/(.+?)/?$'] = 'index.php?taxonomy='.$taxonomy.'&term='.$wp_rewrite->preg_index(1);
//    }
//    $wp_rewrite->rules = array_merge($new_rules, $wp_rewrite->rules);
// 
//    endforeach;
//}


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
//    $newrules['(case)/([^/]+)/?$'] = 'index.php?post_type=case&case-categoy=$matches[1]';
//    $newrules['(case)/([^/]+)/page/([0-9]+)/?$'] = 'index.php?post_type=case&case-categoy=$matches[1]&paged=$matches[2]';
//    $newrules['(event)/([^/]+)/?$'] = 'index.php?post_type=event&event-categoy=$matches[1]';
//    $newrules['(event)/([^/]+)/page/([0-9]+)/?$'] = 'index.php?post_type=event&event-categoy=$matches[1]&paged=$matches[2]';
//    $newrules['(blog)/([^/]+)/?$'] = 'index.php?post_type=blog&blog-categoy=$matches[1]';
//    $newrules['(blog)/([^/]+)/page/([0-9]+)/?$'] = 'index.php?post_type=blog&blog-categoy=$matches[1]&paged=$matches[2]';
  
    $taxonomies = get_taxonomies();
    $taxonomies = array_slice($taxonomies,4,count($taxonomies)-1);
 
    foreach ( $taxonomies as $taxonomy ) :
 
    $args['taxonomy'] = $taxonomy;
    $args['hide_empty'] = false;
 
    $cats = get_categories( $args );
 
    foreach ( $cats as $k => $v ){
        $newrules['case/'.$taxonomy.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=case&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules['case/'.$v->category_nicename.'/?$'] = 'index.php?post_type=case&taxonomy='.$taxonomy.'&term='.$v->category_nicename;
        $newrules['case/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=case&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
      
        $newrules['event/'.$taxonomy.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=event&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules['event/'.$v->category_nicename.'/?$'] = 'index.php?post_type=event&taxonomy='.$taxonomy.'&term='.$v->category_nicename;
        $newrules['event/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=event&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
      
        $newrules['blog/'.$taxonomy.'/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=blog&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
        $newrules['blog/'.$v->category_nicename.'/?$'] = 'index.php?post_type=blog&taxonomy='.$taxonomy.'&term='.$v->category_nicename;
        $newrules['blog/'.$v->category_nicename.'/page/([0-9]{1,})/?$'] = 'index.php?post_type=blog&taxonomy='.$taxonomy.'&term='.$v->category_nicename.'&paged=$matches[1]';
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