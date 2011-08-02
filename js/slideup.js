$ = jQuery;

(function($) {

	$(window).load(function(){
	
		// The magic sliding panels
		$('.entry-content a span.slide-title').css({
			opacity : '0.0'
		}).parent('a').append('<span class="cover-up"></span>');
		$('.entry-content a').mouseover(function(e){
				$(this).find('img.thumbnail').stop().animate({
				marginTop : '-25px'
			}, 100).parent('a').find('span.slide-title').stop().fadeTo("slow",1.0);
		});
		$('.entry-content a').mouseout(function(e){
				$(this).find('img.thumbnail').stop().animate({
				marginTop : '0'
			}, 100).parent('a').find('span.slide-title').stop().fadeTo("slow",0.0);
		});
					
	});

})(jQuery);