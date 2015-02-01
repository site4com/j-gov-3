(function ($){
	$(document).ready(function (){
		
		$('#platform-details').html('<code>' + navigator.userAgent + '</code>');
                
		var accessible_items	= 	$('.c2gaccesskey');
		if(accessible_items.length > 0) {
			accessible_items.each(function (){
				var self	= $(this);
				var shortcut_char	= $(this).attr('accesskey');
				$(document).bind('keydown', 'Alt+Shift+' + shortcut_char,function (evt){
					var _link	= self.attr('href');
					var _target	= self.attr('_target');
					window.location.href	= _link;
					return;
				});
			});
		}
	});

})(jQuery);