$(document).ready(function(){

	var abv = 0;
	var bel = 0;

	var bo = $('#btn').offset();

	$('body').on('click', '#btn', function(){
		$(this).after($("<div/>", {id: 'drag_me'}).append('I am new')).fadeIn(300);
		$('#drag_me').draggable({
			revert: function(event, ui){
				//ui.draggable.draggable('option', 'revert', true);
				return true;
			}
		});
	});	

	$('body #drag_me').draggable({
		revert: function(event, ui){
			return true;
		},
		drag: function(event, ui){
			myOs = $(this).offset();
			$('body #message').html(bo.top+' '+$('#btn').height()+' '+bo.left+' '+$('#btn').width()+'top='+myOs.top+' bottom='+myOs.bottom+' left='+myOs.left+' right='+myOs.right);
		}
	});
	$('body #drop_here').droppable({
		drop: function(event, ui){
			alert(ui.draggable.html());
		}
	});

});