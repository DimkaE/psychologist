$.fn.tabs = function() {
	var selector = this;
	
	this.each(function() {
		var obj = $(this); 
		
		$(obj.attr('data-href')).hide();
		
		obj.click(function() {
			$(selector).removeClass('selected');
			
			$(this).addClass('selected');
			
			$($(this).attr('data-href')).fadeIn();
			
			$(selector).not(this).each(function(i, element) {
				$($(element).attr('data-href')).hide();
			});
			
			return false;
		});
	});

	$(this).show();
	$(this).first().click();
};