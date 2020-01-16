<?php
//パンくずリスト
function echo_breadcrumb() {
  $post_type = get_post_type_object(get_post_type());
  $tax = get_query_var( 'taxonomy');
  $term = get_query_var( 'term');
  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	if ( !is_front_page() && !is_home() ) :
	//HOME>と表示
	$sep = '<span class="sep">></span>';
	$pos = 1;
	echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="'.get_bloginfo('url').'" ><span property="name">トップ</span></a><meta property="position" content="'.$pos++.'"></li>';
	echo $sep;
 
	//投稿記事ページとカテゴリーページでの、カテゴリーの階層を表示
	$cats = '';
	$cat_id = '';
	if ( is_single() ) {
		$cats = get_the_category();
		if( isset($cats[0]->term_id) ) $cat_id = $cats[0]->term_id;
	}
  else if( is_page() ){
      $page_id    = $wp_obj->ID;
      $page_title = apply_filters( 'the_title', $wp_obj->post_title );

      if ( $wp_obj->post_parent !== 0 ) {
        $parent_array = array_reverse( get_post_ancestors( $page_id ) );
        foreach( $parent_array as $parent_id ) {
          $parent_link = esc_url( get_permalink( $parent_id ) );
          $parent_name = esc_html( get_the_title( $parent_id ) );
          echo '<li property="itemListElement" typeof="ListItem">'.
                '<a property="item" typeof="WebPage" href="'. $parent_link .'">'.
                  '<span property="name">'. $parent_name .'</span><meta property="position" content="'.$pos++.'">'.
                '</a>'.
              '</li>';
          echo $sep;
        }
      }
      //echo '<li property="itemListElement" typeof="ListItem"><span property="name">'. esc_html( strip_tags( $page_title ) ) .'</span><meta property="position" content="'.$pos++.'"></li>';    
  }
	else if( is_year() && is_category() ){
			$post_type = get_post_type_object(get_post_type());
			$before = '<li property="itemListElement" typeof="ListItem">';
			$after = '<meta property="position" content="'.$pos++.'"></li>';
			echo $before.'<a property="item" typeof="WebPage" href="'.esc_url(home_url('/')).'news"><span property="name">お知らせ</span></a>'.$after;
			echo $sep;
		the_archive_title( '<li property="itemListElement" typeof="ListItem"><span property="name">', '</span><meta property="position" content="'.$pos++.'"></li>' );
		echo $sep;
	}
	else if( is_year() ){
			$post_type = get_post_type_object(get_post_type());
			$before = '<li property="itemListElement" typeof="ListItem">';
			$after = '<meta property="position" content="'.$pos++.'"></li>';
			echo $before.'<a property="item" typeof="WebPage" href="'.esc_url(home_url('/')).'news"><span property="name">'.$post_type->label.'</span></a>'.$after;
			echo $sep;
	}
	else if ( is_category() ) {
		$cats = get_queried_object();
		$cat_id = $cats->parent;
	}
//	$cat_list = array();
//	while ($cat_id != 0){
//		$cat = get_category( $cat_id );
//		$cat_link = get_category_link( $cat_id );
//		if($cat->category_nicename != 'series' && $cat->category_nicename != 'open'){
//		array_unshift( $cat_list, '<a property="item" typeof="WebPage" href="'.$cat_link.'"><span property="name">'.$cat->name.'</span></a>' );
//		}
//		$cat_id = $cat->parent;
//	}
//	foreach($cat_list as $value){
//		echo '<li property="itemListElement" typeof="ListItem">'.$value.'<meta property="position" content="'.$pos++.'"></li>';
//		echo $sep;
//	}
 
	//現在のページ名を表示
	if ( is_singular() ) {
		$post_type = get_post_type_object(get_post_type());
    global $post;
		if ( is_object_in_term($post->ID, 'blog_category','news') ){
			echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="'.get_bloginfo('url').'/'.$post_type->name.'/news" ><span property="name">お知らせ</span></a><meta property="position" content="'.$pos++.'"></li>';
			echo $sep;
		}elseif( $post_type->name != 'post' && $post_type->name != 'page' ){
			$before = '<li property="itemListElement" typeof="ListItem">';
			$after = '<meta property="position" content="'.$pos++.'"></li>';
			echo $before.'<a property="item" typeof="WebPage" href="'.esc_url(home_url('/')).$post_type->name.'"><span property="name">'.$post_type->label.'</span></a>'.$after;
			echo $sep;
    }
		if ( is_attachment() ) {
			previous_post_link( '<li property="itemListElement" typeof="ListItem"><span property="name">%link</span><meta property="position" content="'.$pos++.'"></li>' );
			echo $sep;
		}
		//the_title( '<li property="itemListElement" typeof="ListItem"><span property="name">', '</span><meta property="position" content="'.$pos++.'"></li>' );
		$before = '<li property="itemListElement" typeof="ListItem"><span property="name">';
		$after = '</span><meta property="position" content="'.$pos++.'"></li>';
		$title = get_the_title();
		if(mb_strlen($title, 'UTF-8')>60){
			$title = mb_substr($title, 0, 58, 'UTF-8').'…';
		}
		echo $before.$title.$after;
	}
	else if( is_author() ) echo '<li property="itemListElement" typeof="ListItem"><span property="name">'.get_the_author_firstname().'</span><meta property="position" content="'.$pos++.'"></li>';
	else if( is_category() ) echo '<li property="itemListElement" typeof="ListItem"><span property="name">'.single_tag_title( '', false ).'</span><meta property="position" content="'.$pos++.'"></li>';
	else if( is_archive() ){
		if( is_tax ){
      if($term){
        if ( !is_tax('blog_category','news')  ){
          $before = '<li property="itemListElement" typeof="ListItem">';
          $after = '<meta property="position" content="'.$pos++.'"></li>';
          echo $before.'<a property="item" typeof="WebPage" href="'.esc_url(home_url('/')).$post_type->name.'"><span property="name">'.$post_type->label.'</span></a>'.$after;
          echo $sep;
          $y = get_query_var('year');
          if($y){
          echo '<li property="itemListElement" typeof="ListItem"><span property="name">'.$y.'年</span><meta property="position" content="'.$pos++.'"></li>';
          }else{
          echo '<li property="itemListElement" typeof="ListItem"><span property="name">'.single_tag_title( '', false ).'</span><meta property="position" content="'.$pos++.'"></li>';
          }
        }
      }else{
        $before = '<li property="itemListElement" typeof="ListItem">';
        $after = '<meta property="position" content="'.$pos++.'"></li>';
        echo $before.'<span property="item" typeof="WebPage"><span property="name">'.$post_type->label.'</span></span>'.$after;
      }
		}else{
			$before = '<li property="itemListElement" typeof="ListItem">';
			$after = '<meta property="position" content="'.$pos++.'"></li>';
			echo $before.'<span property="item" typeof="WebPage"><span property="name">'.$post_type->label.'test</span></span>'.$after;
    }

		//the_archive_title( '<li property="itemListElement" typeof="ListItem"><span property="name">', '</span><meta property="position" content="'.$pos++.'"></li>' );
	}
	else if( is_search() ) echo '<li>検索 : '.get_search_query().'</li>';
	else if( is_404() ) echo '<li>ページが見つかりません</li>';
	else global $unique;
    if( isset($unique['breadcrumb']) ){
      echo $unique['breadcrumb'];
      //echo '<li property="itemListElement" typeof="ListItem"><span property="name">'.$setBread.'</span><meta property="position" content="'.$pos++.'"></li>';
    }
	endif;//< !is_front_page() && !is_home()
}
?>
