/**
 * @author Christopher Wallace
 */
 
$ = jQuery;

(function($) {

	$(window).load(function(){

		// Comment Author URL hover effect
		$('.comment-author a.url').mouseover(function(e){
			var url = $(this).attr('href');
		$(this).parent('span').append('<span class="hover-url">'+url+'</span>');
		})
		$('.comment-author a.url').mouseout(function(e){
		$(this).parent('span').find('.hover-url').remove();
		})
		
		$('#footer .widgetcontainer:nth-child(3n+1)').addClass('reset');
		$('.ie6 #footer .widgetcontainer:nth-child(3n+1),.ie7 #footer .widgetcontainer:nth-child(3n+1)').css({
			clear : 'left'
		});
		
                $('.single .entry-content a:has(img)').addClass('thickbox');
	});

})(jQuery);