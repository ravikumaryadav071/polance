var validation = false;

$(document).ready(function(){

	$("#pic_preview").hide();
	
	$("#profile_pic").on('change', function(){

		$("#message").empty();
		$("#error").empty();
		$("#pic_preview").hide();
		var file = this.files[0];
		var file_type = file.type;
		var valid_formats = ["image/jpeg", "image/jpg", "image/png"];

		if(file){

			if((file_type == valid_formats[0])||(file_type == valid_formats[1])||(file_type == valid_formats[2])){

				validation = true;
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(file);

			}else{

				$("#error").html("<p>This is not valid image format.</p>").fadeOut(2000);
				$("#pic_preview").attr('src', 'images/noimage.png').show('slow');	
				validation = false;		

			}

		}

	});

	function imageIsLoaded(e){

		//alert('here');
		$("#pic_preview").attr('src', e.target.result).show('slow');

	}

});