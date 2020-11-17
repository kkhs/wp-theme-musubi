$(document).ready(function() {
  $(".btn_menu").click(function(){
    $('body').toggleClass('body--menuOpen');
    $('#header .header_navi').slideToggle(250);
  });
  // サブメニュー（SP）
  $(".header_btm ul.header_menu li.sub_A").click(function(){
    $('.header_btm ul.header_menu li.sub_A').toggleClass('sub--menuOpen');  // クリックでクラス付与。
  });
  $(".header_btm ul.header_menu li.sub_B").click(function(){
    $('.header_btm ul.header_menu li.sub_B').toggleClass('sub--menuOpen');
  });
  // サブメニュー（PC）
  if (window.matchMedia('(min-width:960px)').matches) {
      $("ul.header_menu li").mouseenter(function(){
        $(this).siblings().find("ul").hide();  // 兄弟要素に含まれるサブメニューを全部消す。
        $(this).children().slideDown(250);     // 自分のサブメニューを表示する。
    });
    // ▼どこかがクリックされたらサブメニューを消す
      $('html').click(function() {
        $('ul.header_menu ul').slideUp(250);
    });
  }
});