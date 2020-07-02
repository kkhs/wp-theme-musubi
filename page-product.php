<?php get_header(); ?>

<style>
.popup_outer {
  margin-top: 0;
  margin-bottom: 1.4em;
}
.popup_outer p.link {
  color: #4ecdc4;
}
.popup_outer p.link:before {
  display: inline-block;
  content: '';
  width: 25px;
  height: 25px;
  background-image: url(<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_image@2x.png);
  background-size: contain;
  vertical-align: bottom;
  margin-right: .6em;
}
#inline-popup,
#inline-popup_2,
#inline-popup_3,
#inline-popup_4,
#inline-popup_5,
#inline-popup_6 {
  margin: 0 auto;
  width: 96%;
  min-height: 300px;
  background: #f1f1f1;
  padding: 3em 1em 3em;
  border-radius: 2px;
  text-align: center;
  font-size: 90%;
  position: relative;
  box-shadow: 1px 6px 8px 3px rgba(0,0,0,.25);
  display: flex;
  justify-content: center;
  align-items: center;
}
#inline-popup .img_area,
#inline-popup_2 .img_area,
#inline-popup_3 .img_area,
#inline-popup_4 .img_area,
#inline-popup_5 .img_area,
#inline-popup_6 .img_area {
  border: 1px solid #eee;
  width: 100%;
  margin: 0 auto;
}
.mfp-container {
  background: rgba(0,0,0,.35);
}
.mfp-close-btn-in .mfp-close::before {
    position: absolute;
    top: 5%;
    right: 2%;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 75%;
    content: "\f00d";
    padding-right: 1em;
    color: #4ecdc4;
}
</style>

<div id="content" class="productcustom">
  <article class="article_main">
    <section id="top">
      <div class="title_area setElm">
        <h1>Musubiサービス詳細</h1>
        <p class="sub">選ばれ続ける薬局になるために</p>
        <p class="focus">薬局体験アシスタント<br class="display-sp">Musubiが導く<span>3つ</span>の薬局変革</p>
      </div>
      <div class="point_base">
        <div class="section_inner">
          <div class="point_area setElm">
            <div class="box first">
              <div class="circle">
                <div class="icon_area">
                  <figure>
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_1@2x.png" alt="">
                  </figure>
                </div>
                <div class="txt_area">
                  <h3>店舗の状況把握<!--<br>経営改善--></h3>
                </div>
              </div>
              <div class="btn_area">
                <div class="btn_txt">
                  <a href="#function_1">
                    <div class="icon">
                      <span class="icon">
                      <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_3point_1.png" alt="">
                      </span>
                    </div>
                    <p class="txt">
                      業務状況や<br class="display-pc">収益の見える化
                    </p>
                    <div class="arrow"></div>
                  </a>
                </div>
                <div class="btn_txt">
                  <a href="#function_2">
                    <div class="icon">
                      <span class="icon">
                      <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_3point_2.png" alt="">
                      </span>
                    </div>
                    <p class="txt">
                      複数店舗間の<br class="display-pc">患者情報連携
                    </p>
                    <div class="arrow"></div>
                  </a>
                </div>
              </div>
            </div>
            <div class="box sec">
              <div class="circle">
                <div class="icon_area">
                  <figure>
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_2@2x.png" alt="">
                  </figure>
                </div>
                <div class="txt_area">
                  <h3>働き方改革</h3>
                </div>
              </div>
              <div class="btn_area">
                <div class="btn_txt">
                  <a href="#function_3">
                    <div class="icon">
                      <span class="icon">
                      <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_3point_3.png" alt="">
                      </span>
                    </div>
                    <p class="txt">
                      薬歴業務の効率化
                    </p>
                    <div class="arrow"></div>
                  </a>
                </div>
                <div class="btn_txt">
                  <a href="#function_4">
                    <div class="icon">
                      <span class="icon">
                      <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_3point_4.png" alt="">
                      </span>
                    </div>
                    <p class="txt">
                      在宅業務の効率化
                    </p>
                    <div class="arrow"></div>
                  </a>
                </div>
              </div>
            </div>
            <div class="box thi">
              <div class="circle">
                <div class="icon_area">
                  <figure>
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_3@2x.png" alt="">
                  </figure>
                </div>
                <div class="txt_area">
                  <h3>患者満足</h3>
                </div>
              </div>
              <div class="btn_area">
                <div class="btn_txt">
                  <a href="#function_5">
                    <div class="icon">
                      <span class="icon">
                      <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_3point_5.png" alt="">
                      </span>
                    </div>
                    <p class="txt">
                      服薬指導・<br class="display-pc">患者コミュニケーション
                    </p>
                    <div class="arrow"></div>
                  </a>
                </div>
                <div class="btn_txt">
                  <a href="#function_6">
                    <div class="icon">
                      <span class="icon">
                      <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_3point_6b.png" alt="">
                      </span>
                    </div>
                    <p class="txt">
                      服薬期間中の<br class="display-pc">フォロー
                    </p>
                    <div class="arrow"></div>
                  </a>
                </div>
              </div>
            </div>
            <div class="border"></div>
          </div>
        </div>
      </div>
    </section>

    <section id="bg" class="setElm">
      <div class="bg_area">
        <h2>Musubiなら、実現できます。</h2>
      </div>
    </section>

    <section id="functinon_area">
      <div class="bg">
        <div class="section_inner setElm">
          <div class="colum_wh_outer">

            <!-- colum_1 -->
            <div class="colum_wh first">
              <div class="title_sp">
                <div class="icon">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_1@2x.png" alt="">
                </div>
                <p>店舗の状況把握</p>
              </div>
              <div class="box" id="function_1">
                <div class="icon_area">
                  <div class="icon">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_1@2x.png" alt="">
                  </div>
                </div>
                <div class="caption_box">
                  <p class="category display-pc">店舗の状況把握</p>
                  <h3>業務状況や収益の見える化</h3>
                  <p class="task">自局の服薬指導や薬歴業務の現状を、どう把握するか？</p>
                  <p class="text">
                    薬歴完了率やSOAPそれぞれの平均記載時間といった薬剤師の業務状況を表すデータから、調剤事業の売上や後発品比率をはじめとする店舗経営データ、
                    処方箋数や再来率・新患率など患者さんとの関係性を表すデータまで、Musubiが自動的に“見える化”。
                    書けるだけの電子薬歴とは異なり、解決すべき課題の発見・把握をも効率化します。
                  </p>
                  <div class="popup_outer">
                    <div class="inline-link" data-mfp-src="#inline-popup">
                      <p class="link">イメージを見る</p>
                    </div>
                    <div id="inline-popup" class="mfp-hide">
                      <div class="pd-colum">
                        <div class="img_area">
                          <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/product_1.png" alt="">
                        </div>
                      </div>
                      <div class="mfp-close"></div>
                    </div>
                  </div>
                  <!--
                  <div class="btn_area">
                    <a href="" class="txt_btn"><span>Musubi Insite</span></a>
                  </div>
                  -->
                </div>
                <div class="caption_box">
                  <div class="img_area">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/product_1.png" alt="">
                  </div>
                </div>
              </div>
              <div class="box" id="function_2">
                <div class="icon_area">
                  <div class="icon">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_1@2x.png" alt="">
                  </div>
                </div>
                <div class="caption_box">
                  <p class="category display-pc">店舗の状況把握</p>
                  <h3>複数店舗間の患者情報連携</h3>
                  <p class="task">店舗をまたいだ情報管理を、もっと効率化できないか？</p>
                  <p class="text">
                    同一法人の店舗間で、患者情報を自動連携。過去の処方履歴や薬歴をMusubiを利用するすべての店舗で確認できるため、
                    正確な情報に基づく適切な服薬指導が可能になります。もちろん複数店舗を利用する患者さんにとっては「何度も同じことを尋ねられるわずらわしさ」がなくなるとともに、
                    安心感につながり、薬局の継続利用意識を高める効果も。オンプレミス（店舗据え置き型）のレセコン・電子薬歴と異なる、クラウド型サービスならではの特徴です。
                  </p>
                  <div class="popup_outer">
                    <div class="inline-link" data-mfp-src="#inline-popup_2">
                      <p class="link">イメージを見る</p>
                    </div>
                    <div id="inline-popup_2" class="mfp-hide">
                      <div class="pd-colum">
                        <div class="img_area">
                          <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/product_2b@2x.png" alt="">
                        </div>
                      </div>
                      <div class="mfp-close"></div>
                    </div>
                  </div>
                  <div class="btn_area first">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>product/product-linkage/" class="txt_btn"><span>患者情報連携機能</span></a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>product/product-security/" class="txt_btn"><span>クラウドとは？</span></a>
                  </div>
                </div>
                <div class="caption_box img">
                  <div class="img_area">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/product_2b@2x.png" alt="">
                  </div>
                </div>
              </div>
              <div class="border first"></div>
            </div>
            <!--// colum_1 -->

            <!-- colum_2 -->
            <div class="colum_wh sec">
              <div class="title_sp">
                <div class="icon">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_2@2x.png" alt="">
                </div>
                <p>働き方改革</p>
              </div>
              <div class="box" id="function_3">
                <div class="icon_area">
                  <div class="icon">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_2@2x.png" alt="">
                  </div>
                </div>
                <div class="caption_box">
                  <p class="category display-pc">働き方改革</p>
                  <h3>薬歴業務の効率化</h3>
                  <p class="task">薬歴に追われる状況を脱し、いかに余裕を生み出すか？</p>
                  <p class="text">
                  Musubiなら、薬歴作成が患者さんへの服薬指導中にほぼ完了。
                  服薬指導の際、タブレットPCの画面をタッチするだけで、患者さんにご説明した内容が薬歴用に最適化されたテキストに置き換えられて、SOAP形式に自動反映されます。
                  一件あたり10分以上かかっていた薬歴作成が、従来の電子薬歴より内容充実した上で、わずか2〜3分に効率化した実例も。
                  もちろん、服薬情報提供書（トレーシングレポート）も、Musubiで作成可能です。
                  </p>
                  <div class="popup_outer">
                    <div class="inline-link" data-mfp-src="#inline-popup_3">
                      <p class="link">イメージを見る</p>
                    </div>
                    <div id="inline-popup_3" class="mfp-hide">
                      <div class="pd-colum">
                        <div class="img_area">
                        <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/product_3.gif" alt="">
                        </div>
                      </div>
                      <div class="mfp-close"></div>
                    </div>
                  </div>
                  <div class="btn_area first">
                    <a href="#function_3" class="txt_btn"><span>服薬指導中にタッチで薬歴下書き完成</span></a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>product/product-report/" class="txt_btn"><span>トレーシングレポート作成機能</span></a>
                  </div>
                </div>
                <div class="caption_box img">
                  <div class="img_area">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/product_3.gif" alt="">
                  </div>
                </div>
              </div>
              <div class="box" id="function_4">
                <div class="icon_area">
                  <div class="icon">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_2@2x.png" alt="">
                  </div>
                </div>
                <div class="caption_box">
                  <p class="category display-pc">働き方改革</p>
                  <h3>在宅業務の効率化</h3>
                  <p class="task">需要の増える在宅対応、効率的な業務フローを<br class="display-pc">どう組み立てるか？</p>
                  <p class="text">
                  施設・居宅訪問など、在宅業務おいて必要となる計画書・報告書をMusubi上で簡単に作成することができます。
                  クラウド型サービスだから、インターネット環境さえあれば外出先でも作業が可能。店舗内で電子薬歴を使うのと同じように、
                  出先での薬歴作成も問題なし。各書類の内容は、すでに記載されている患者情報・薬歴から自動的に転記されるので、
                  あっという間に作成できます。必要な情報が伝わりやすい報告書のデザインも好評です。
                  </p>
                  <div class="popup_outer">
                    <div class="inline-link" data-mfp-src="#inline-popup_4">
                      <p class="link">イメージを見る</p>
                    </div>
                    <div id="inline-popup_4" class="mfp-hide">
                      <div class="pd-colum">
                        <div class="img_area">
                        <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/product_4.gif" alt="">
                        </div>
                      </div>
                      <div class="mfp-close"></div>
                    </div>
                  </div>
                  <div class="btn_area first">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>product/product-zaitaku/" class="txt_btn"><span>在宅計画書・報告書作成機能</span></a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>product/product-security/" class="txt_btn"><span>クラウドのメリット</span></a>
                  </div>
                </div>
                <div class="caption_box img">
                  <div class="img_area">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/product_4.gif" alt="">
                  </div>
                </div>
              </div>
              <div class="border"></div>
            </div>
            <!--// colum_2 -->

            <!-- colum_3 -->
            <div class="colum_wh thi">
              <div class="title_sp">
                <div class="icon">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_3@2x.png" alt="">
                </div>
                <p>患者満足</p>
              </div>
              <div class="box" id="function_5">
                <div class="icon_area">
                  <div class="icon">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_3@2x.png" alt="">
                  </div>
                </div>
                <div class="caption_box">
                  <p class="category display-pc">患者満足</p>
                  <h3 class="function_5">服薬指導・患者<br class="display-sp">コミュニケーション</h3>
                  <p class="task">患者さんとの価値あるコミュニケーションを、<br class="display-pc">いかに実践していくか？</p>
                  <p class="text">
                    Musubiは、患者さんに画面をお見せしながら服薬指導できます。
                    季節や患者さんごとに適した指導内容・イラスト付きのアドバイスが表示され、目と耳の両方から患者さんへの意識づけが可能です。
                    Musubiがおすすめしたアドバイスをきっかけに患者さんとの新たな会話が生まれ、
                    より深い状況把握ができるなど、患者さんとの関係構築にも効果的。
                    画面を共有しながらのビジュアルコミュニケーションは、オンライン服薬指導にも最適です。
                  </p>
                  <div class="popup_outer">
                    <div class="inline-link" data-mfp-src="#inline-popup_4">
                      <p class="link">イメージを見る</p>
                    </div>
                    <div id="inline-popup_4" class="mfp-hide">
                      <div class="pd-colum">
                        <div class="img_area">
                        <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/product_5.jpg" alt="">
                        </div>
                      </div>
                      <div class="mfp-close"></div>
                    </div>
                  </div>
                  <!--
                  <div class="btn_area">
                    <p class="txt_btn">ビジュアルコミュニケーション</p>
                  </div><br class="display-sp">
                  -->
                  <div class="btn_area first">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>product/continuous/" class="txt_btn"><span>継続的な薬学管理</span></a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>product/product-dsu/" class="txt_btn"><span>ハイリスク薬のDSUに対応</span></a>
                  </div><br>
                  <div class="btn_area">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>product/product-checkprescription/" class="txt_btn"><span>処方チェック機能</span></a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>product/product-checkup/" class="txt_btn"><span>検査値管理機能</span></a>
                  </div><br>
                  <div class="btn_area">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>product/product-update/" class="txt_btn"><span>高頻度アップデート</span></a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>blog/200422-musubi-remote-movie/" class="txt_btn"><span>オンライン服薬指導</span></a>
                  </div>
                </div>
                <div class="caption_box img">
                  <div class="img_area">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/product_5.jpg" alt="">
                  </div>
                </div>
              </div>
              <div class="box" id="function_6">
                <div class="icon_area">
                  <div class="icon">
                  <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/icon_point_3@2x.png" alt="">
                  </div>
                </div>
                <div class="caption_box">
                  <p class="category display-pc">患者満足</p>
                  <h3>服薬期間中のフォロー</h3>
                  <p class="task">患者満足を実現しながら、<br class="display-pc">現実的で継続可能な業務フローをどう構築するか？</p>
                  <p class="text">
                    新たに義務化されることとなった、服薬期間中のフォローアップ。これからの時代において、
                    薬局・薬剤師には、患者さんにとってのより身近な専門家であることが求められるようになるでしょう。
                    Musubiは、連動する患者さん向け“おくすり連絡帳アプリ”を通じて、服薬期間中フォローを軸とした患者さんとの関係づくりをサポート。
                    患者さんとの過剰なやり取りや極端な連絡不足を防ぎ、「必要な患者さんに」「適切な労力で」コミュニケーションを図るための業務フロー構築をアシストします。
                  </p>
                  <!--
                  <div class="btn_area">
                    <a href="" class="txt_btn"><span>●●機能</span></a>
                    <a href="" class="txt_btn"><span>●●機能</span></a>
                  </div>
                  -->
                </div>
                <div class="caption_box">
                  <div class="img_area img">
                  </div>
                </div>
              </div>
              <div class="border last"></div>
            </div>
            <!--// colum_3 -->
            <div class="border"></div>
          </div>
          <div class="cta_area setElm">
            <h2>さあ、選ばれる薬局へ</h2>
            <div class="cta_box">
              <div class="box first">
                <figure>
                <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/img_cta_1.png" alt="">
                </figure>
                <h3>質を伴った<br class="display-pc">業務効率化</h3>
                <p>服薬指導の内容が、自動で薬歴へ。外来でも在宅でも、より深く患者さんに向き合うことができます。</p>
              </div>
              <div class="box sec">
                <figure>
                <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/img_cta_2.png" alt="">
                </figure>
                <h3>シンプルな画面<br class="display-pc">操作方法</h3>
                <p>従来のレセコンや電子薬歴とは一線を画すシンプルな画面に、画面タッチ中心の操作。使う人を選びません。</p>
              </div>
              <div class="box thi">
                <figure>
                <img src="<?php echo_assets_root_url(); ?>assets/images/product/custom/img_cta_3b.png" alt="">
                </figure>
                <h3>マンツーマン<br class="display-pc">サポート</h3>
                <p>満足度90％以上。継続的なMusubiの活用サポートで、PC操作やITシステムが苦手な薬剤師さんも安心です。</p>
              </div>
            </div>
          </div>
          <div class="btn_area">
            <a href="/contact" class="btn cta">お気軽にお問い合わせください</a>
          </div>
        </div>
      </div>
    </section>

    <section id="case">
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
    </section>

    <section id="event_custom">
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
                    <p class="title"><?php the_title(); ?></p>
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
                slidesToShow: 4,
                slidesToScroll: 1,
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
    </section>

    <section id="doc_custom">
      <div class="bg">
        <h2>お役立ち資料</h2>
        <div class="section_inner">
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
      </div>
    </section>

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
            <a href="/contact/" class="btn cta">資料をダウンロードする</a>
        </div>
      </div>
    </section> 
    
  </article>
</div>

<?php get_footer(); ?>

<script>
  $('a[data-lightbox="flow"]').simpleLightbox({
    captionAttribute: 'alt',
    widthRatio: .5,
    heightRatio: .4
  });
</script>
</body>
</html>              
