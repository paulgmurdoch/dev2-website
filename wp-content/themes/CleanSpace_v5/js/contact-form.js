$(document).ready(function() {
	$('form#contactForm').submit(function() {
		$('form#contactForm .error').remove();
		var hasError = false;
		$('.requiredField').each(function() {
			if(jQuery.trim($(this).val()) == '') {
				var labelText = $(this).prev('name').contactName();
				$(this).parent().append('<span class="error">You forgot to enter your name</span>');
				hasError = true;
				
			} else if($(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim($(this).val()))) {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">You entered an invalid email</span>');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			$('form#contactForm li.buttons button').fadeOut('normal', function() {
				$(this).parent().append('<img src="/wp-content/themes/ClearSpace/images/loading.gif" alt="Loading&hellip;" height="31" width="31" />');
			});
			var formInput = $(this).serialize();
			$.post($(this).attr('action'),formInput, function(data){
				$('form#contactForm').slideUp("fast", function() {				   
					$(this).before('<p class="thanks"><strong>Thanks!</strong> Your message was successfully sent.</p>');
				});
			});
		}
		
		return false;
		
	});
});