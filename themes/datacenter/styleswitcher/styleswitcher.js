jQuery(document).ready(function(){
	jQuery('.single-type-box').hover(function(){
		jQuery(this).find('ul').stop(true,true).slideToggle(100)
	});	
});		