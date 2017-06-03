$(document).ready(function(){

	$('input[hidden="hidden"]').hide();

	$('body').on('click', '#change_dob', function(){
		$('#dob').fadeIn();
	});

});