jQuery(function($){
	// on upload button click
	$('body').on( 'click', '.img-upl', function(e){

		e.preventDefault();
 
		var button = $(this),
		custom_uploader = wp.media({
			title: 'Insert image',
			library : {
				type : 'image'
			},
			button: {
				text: 'Use this image' 
			},
			multiple: false
		}).on('select', function() { 
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			button.html('<img src="' + attachment.url + '">').next().val(attachment.id).next().show();
			$('#logo').val( $('#logo').siblings(".img-upl").children('img').attr('src') );
			$('#logo_white').val( $('#logo_white').siblings(".img-upl").children('img').attr('src') );
			$('#logo_top_white').val( $('#logo_top_white').siblings(".img-upl").children('img').attr('src') );
			$('#logo_top').val( $('#logo_top').siblings(".img-upl").children('img').attr('src') );
			$('.hidden_icon').each(function(icon){	
				$(this).val($(this).siblings('.previewIcon').children('img').attr('src'));
			});
		}).open();
 
	});
 
});