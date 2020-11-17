nallow = false;
touch = false;
$(document).ready(function() {
	var wWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
	var breakpoint = 961;
	if(wWidth < breakpoint){
		nallow = true;
	}else{
		nallow = false;
	}
	if($('body').hasClass('touch')){
		touch = true;
	}else{
		touch = false;
	}
  
  scrFunc();
	
  var scroll = new SmoothScroll('a[href*="#"]',{
    header: '.header_inner',
    speed: 800,
    speedAsDuration: true,
    easing: 'easeInOutCubic',
  });
  
  $(".btn_menu").click(function(){
    $('body').toggleClass('body--menuOpen');
    $('#header .header_navi').slideToggle(250);
  });
  
  $('#kv,#top').imagesLoaded().always(function(){
    $('#kv,#top').addClass('init');
  });
  
  $('.setElm').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
      if (isInView) {
        $(this).addClass('inview');
        if (visiblePartX == 'both' && visiblePartY == 'both'){
          $(this).addClass('inviewAll');
        }
      }
  });
  
  $(".faq_q").click(function(){
    var a = $(this).siblings('.faq_a');
    a.slideToggle().toggleClass('open');
    $(this).toggleClass('open');
  });

  // サブメニュー（SP）
  $(".header_btm ul.header_menu li.sub_A").click(function(){
    $('.header_btm ul.header_menu li.sub_A').toggleClass('sub--menuOpen');
  });
  $(".header_btm ul.header_menu li.sub_B").click(function(){
    $('.header_btm ul.header_menu li.sub_B').toggleClass('sub--menuOpen');
  });
  
  // サブメニュー（PC）
  if (window.matchMedia('(min-width:960px)').matches) {
    //PC処理
    // ▼マウスが載ったらサブメニューを表示
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

$(window).on('scroll resize', function() {
	scrFunc();
});
function scrFunc(){
	var scrTop = $(window).scrollTop();
  var h = $('#header'),
      hh = h.height();
  if(scrTop > hh*2){
    h.addClass('fixed');
  }else{
    h.removeClass('fixed');
  }
}

// Magnific Popup
$(function() {
  $('.inline-link').magnificPopup({
  type:'inline'
  });
});
