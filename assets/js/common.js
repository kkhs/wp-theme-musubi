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
	
	$('a[href^="#"]').click(function(e) {
	  e.preventDefault();
	  var anc = $(this).attr('href'),
        target = $(anc),
        hh = $('#header').height();
        scr = target.offset().top;
	  $('html,body').animate({scrollTop:(scr-hh)},800,'easeInOutExpo');
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
