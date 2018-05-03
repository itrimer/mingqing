(function($) {
	$.fn.accordion = function(options) {
		var settings = $.extend({}, {open: false}, options);
		return this.each(function() {
			var dts = $(this).children('dt');
			dts.click(onClick);
			dts.each(reset);
			if(settings.open) open($(this).children('dt:first-child'));
		});
		
		function onClick() {
			if($(this).hasClass("open")){
				hide($(this));
			} else {
				open($(this));
			}
			
			return false;
		}
		
		function hide(obj) {
			obj.next().slideUp('fast');
			obj.removeClass("open");
		}
		function open(obj) {
			obj.next().slideDown('fast');
			obj.addClass("open");
		}
		
		function reset() {
			$(this).next().hide();
		}
	}
})(jQuery);
