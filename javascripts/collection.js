var cc = 0;  //collection click
$(document).ready(function(){

	$('body #post').draggable({
		revert: function(event, ui){
			$('body #my_collection').slideUp(300);
			return true;
		}, 

		drag: function(event, ui){

			var cb_pos = $('body #collection_box').offset();
			var	cb_t = cb_pos.top;
			var	cb_l = cb_pos.left;
			var	cb_r = cb_l + $('body #collection_box').width();
			var	cb_b = cb_t + $('body #collection_box').height();

			var this_pos = $(this).offset();
			var tp_t = this_pos.top;
			var tp_l = this_pos.left;
			var tp_b = tp_t + $(this).height();
			var tp_r = tp_l + $(this).width();
			if(tp_t<cb_t && tp_l<cb_l && tp_r<cb_r && tp_b>cb_b){
				$('body #my_collection').slideDown(300);
			}
		}

	});

	$('body').on('click', '#show_collection', function(){
		cc++;
		if(cc==1){
			$('body #my_collection').slideDown(300);
		}else{
			$('body #my_collection').slideUp(300);
			cc = 0;
		}
	});

	$('body #collection').droppable({
		tolerance: 'pointer',
		activeClass: "ui-state-hover",
		hoverClass:"ui-state-active",
		drop: function(event, ui){
			$(this).addClass('ui-state-highlight');
			
			var post_id = ui.draggable.parent().find('#post_id').val();
			var user = ui.draggable.parent().find('#user').val();
			var post_type = ui.draggable.parent().find('#post_type').val();

			if(post_id != undefined && user != undefined && post_type != undefined){

				var thisCol = $(this).find('#collection_id').val();
				myThis = $(this);

				$.ajax({

					url: 'php_response_to_ajax/add_post_to_clc.php?user='+user+'&post_id='+post_id+'&post_type='+post_type+'&clc='+thisCol,
					type: 'POST',
					data: false,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data){
						$('body #message').html(data).show().fadeOut(1500);
						if(data=='ADDED'){
							var counter_elem = myThis.find('#clc_counter');
							var counter = counter_elem.html();
							counter = parseInt(counter);
							counter++;
							counter_elem.html(counter);
						}
					},
					error: function(){
						$('body #message').html('Connection to server failed.').show().fadeOut(1500);
					}

				});

			}else{
				user = ui.draggable.parent().find('#col_name').val();
				post_id = ui.draggable.parent().find('#col_post_id').val();
				post_type = 'COLLABORATION';

				if(post_id != undefined && user != undefined && post_type != undefined){

					var thisCol = $(this).find('#collection_id').val();
					myThis = $(this);
					$.ajax({

						url: 'php_response_to_ajax/add_post_to_clc.php?user='+user+'&post_id='+post_id+'&post_type='+post_type+'&clc='+thisCol,
						type: 'POST',
						data: false,
						cache: false,
						contentType: false,
						processData: false,
						success: function(data){
							$('body #message').html(data).show().fadeOut(1500);
							if(data=='ADDED'){
								var counter_elem = myThis.find('#clc_counter');
								var counter = counter_elem.html();
								counter = parseInt(counter);
								counter++;
								counter_elem.html(counter);
							}
						},
						error: function(){
							$('body #message').html('Connection to server failed.').show().fadeOut(1500);
						}

					});
				}

			}
			
		}
	});

	$('body').on('mouseover', '#collection', function(){
		$(this).css('border', '1px solid blue');
	});

	$('body').on('mouseout', '#collection', function(){
		$(this).css('border', '1px solid black');
	});

	$('body').on('keyup', '#clc_form_text', function(){

		var clc_name = $(this).val();
		clc_name = clc_name.trim();
		if(clc_name != ""){
			$.ajax({

				url: 'php_response_to_ajax/collection_suggestion.php?name='+clc_name,
				type: 'POST',
				data: false,
				cache: false,
				processData: false,
				contentType: false,
				success: function(data){
					$('body #clc_name_sugsn').html(data);
				},
				error: function(){
					$('body #message').html('Connection to server failed.').show().fadeOut(1500);
				}

			});
		}else{
			$('body #clc_name_sugsn').slideUp(300);
		}

	});

	$('body').on('submit', '#create_clc_form', function(e){

		e.preventDefault();
		var myThis = $(this);
		$.ajax({

			url: 'php_response_to_ajax/create_collection.php',
			type: 'POST',
			cache: false,
			data: new FormData(this),
			contentType: false,
			processData: false,
			success: function(data){
				myThis.parent().parent().find('p').remove();
				myThis.parent().parent().find('#clc_form_div').after(data).slideDown(300);
				$('body #collection').droppable({
					tolerance: 'pointer',
					activeClass: "ui-state-hover",
					hoverClass:"ui-state-active",
					drop: function(event, ui){
						$(this).addClass('ui-state-highlight');
						
						var post_id = ui.draggable.parent().find('#post_id').val();
						var user = ui.draggable.parent().find('#user').val();
						var post_type = ui.draggable.parent().find('#post_type').val();

						if(post_id != undefined && user != undefined && post_type != undefined){

							var thisCol = $(this).find('#collection_id').val();
							var myThis = $(this);

							$.ajax({

								url: 'php_response_to_ajax/add_post_to_clc.php?user='+user+'&post_id='+post_id+'&post_type='+post_type+'&clc='+thisCol,
								type: 'POST',
								data: false,
								cache: false,
								contentType: false,
								processData: false,
								success: function(data){
									$('body #message').html(data).show().fadeOut(1500);
									if(data=='ADDED'){
										var counter_elem = myThis.find('#clc_counter');
										var counter = counter_elem.html();
										counter = parseInt(counter);
										counter++;
										counter_elem.html(counter);
									}
								},
								error: function(){
									$('body #message').html('Connection to server failed.').show().fadeOut(1500);
								}

							});

						}else{
							
							user = ui.draggable.parent().find('#col_user').val();
							post_id = ui.draggable.parent().find('#col_post_id').val();
							post_type = 'COLLABORATION';

							if(post_id != undefined && user != undefined && post_type != undefined){

								var thisCol = $(this).find('#collection_id').val();
								myThis = $(this);

								$.ajax({

									url: 'php_response_to_ajax/add_post_to_clc.php?user='+user+'&post_id='+post_id+'&post_type='+post_type+'&clc='+thisCol,
									type: 'POST',
									data: false,
									cache: false,
									contentType: false,
									processData: false,
									success: function(data){
										$('body #message').html(data).show().fadeOut(1500);
										alert(data);
										if(data=='ADDED'){
											var counter_elem = myThis.find('#clc_counter');
											var counter = counter_elem.html();
											counter = parseInt(counter);
											counter++;
											counter_elem.html(counter);
										}
									},
									error: function(){
										$('body #message').html('Connection to server failed.').show().fadeOut(1500);
									}

								});
							}

						}
						
					}
				});
			},
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});

	});

	$('body').on('click', '#collect', function(){

		$('body #collect').each(function(){

			$(this).attr('disabled', 'disabled');
			$(this).parent().find('#collect_cb').show();

		});

	});

	$('body').on('click', '#collect_cb', function(e){

		$('#my_collection').slideDown(500);

	});

	$('body').on('click', '#collection', function(){

		var thisClc = $(this).find('#collection_id').val();
		var myThis = $(this);
		var form = new FormData();

		$('body #remove_checked').show();

		form.append('clc', thisClc);

		$('body #collect_cb').each(function(){

			if($(this).prop('checked')){

				var post_id = $(this).parent().find('#post_id').val();
				var user = $(this).parent().find('#user').val();
				var post_type = $(this).parent().find('#post_type').val();
				if(post_type == undefined && post_id == undefined && user == undefined){
					post_id = $(this).parent().find('#col_post_id').val();
					user = $(this).parent().find('#col_name').val();
					post_type = 'COLLABORATION';
				}
			
				form.append('post_id[]', post_id);
				form.append('user[]', user);
				form.append('post_type[]', post_type);
			}

		});
		$.ajax({

			url: 'php_response_to_ajax/add_to_collection.php',
			type: 'POST',
			data: form,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){
				var counter_elem = myThis.find('#clc_counter');
				var counter = counter_elem.html();
				counter = parseInt(counter);
				var added = parseInt(data);
				counter = counter+added;
				counter_elem.html(counter);
				alert(data);
			}, 
			error: function(){
				$('body #message').html('Connection to server failed.').show().fadeOut(1500);
			}

		});

	});

	$('body').on('click', '#remove_checked', function(){

		$('body #collect_cb').each(function(){
			if($(this).prop('checked')){
				$(this).removeAttr('checked');
			}
		});

		$('body #collect_cb').each(function(){
			$(this).hide();
		});

		$('body #collect').each(function(){
			$(this).removeAttr('disabled');
		});

		$(this).hide();

	});

});