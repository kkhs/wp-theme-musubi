<div id="sidebar" class="sidebar widget-area" role="complementary">
	<?php
		$tax_query = array(
			'taxonomy' => 'blog_category',
			'field' => 'slug',
			'terms' => 'news',
			'operator' => 'NOT IN',
		);
		$args = array(
			'post_type' => $post_type,
			'posts_per_page'=> 5,
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
		<div class="area">
			<div class="bnr_box">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>product/" class="bnr">
					<img src="<?php echo_assets_root_url(); ?>assets/images/common/bnr_product_b@2x.png" alt="薬局体験アシスタントとは？">
				</a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>contact/" class="bnr">
					<img src="<?php echo_assets_root_url(); ?>assets/images/common/bnr_contact_b@2x.png" alt="お問い合わせ・資料請求">
				</a>
			</div>
		</div>
		<div class="area">
			<h2 class="tit">最新の記事</h2>
			<ul class="posts">
				<?php
					while ( $query->have_posts() ) {
					$query->the_post();    
				?>
				<li class="post">
					<a href="<?php the_permalink() ?>">
						<span class="desc">
							<h2 class="tit"><?php the_title(); ?></h2>
							<span class="meta">
								<?php
									$terms = get_the_terms( $post->ID, 'blog_category' );
									if ( $terms && ! is_wp_error( $terms ) ) :
								?>
								<ul class="category">
									<?php foreach ( $terms as $term ) { ?>
										<li class="tag"><span class="label"><?php echo $term->name; ?></span></li>
									<?php } ?>
								</ul>
								<span class="date">| <?php the_time('Y/n/j'); ?></span>
								<?php endif; ?>
							</span>
						</span>
					</a>
				</li>
				<?php } // end while ?>
			</ul>
		</div>
		<div class="area">
			<h2 class="tit">カテゴリ一覧</h2>
			<ul class="posts">
				<li class="category">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>blog/musubi/">Musubiについて</a>
				</li>
				<li class="category">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>blog/report/">イベントレポート</a>
				</li>
			</ul>
		</div>

	</section>
	
	<?php
		endif;
		wp_reset_query();
	?>
</div><!-- #primary-sidebar -->