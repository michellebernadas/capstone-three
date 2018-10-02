$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

});

$(document).ready(function() {
		$('img.down').hide();
	$('.card-header').click(function(){
		$(this).next().slideToggle("500");

    $("i", this).toggleClass("fas fa-angle-double-down fas fa-angle-double-up");

	})

	$('button.btn.remove_list').click(function() {
		let id = $(this).attr('id');
	})
})

$('#thread_content').richText();
$('#thread').richText();
$('#commented_thread').richText();

$('#post_btn').click(function() {

var info = $.trim($(".richText-editor").text());
console.log(info)
})


$(document).on("click", "button#reply_thread", function() {
	let reply_thread = $('#thread_content').val();
	let thread_id = $('#reply_thread').data('index');
	let comment_id = $(this)
	let dummy_image = $('ul.thread').find('img').attr('onerror');

	$.ajax({
		url:'/comments',
		method: 'post',
		data: {
			reply_thread:reply_thread,
			thread_id:thread_id
		},
		success:function(data) {
			$('.comment-container').append('\
				<ul class="list-unstyled replies" id="'+data.id+'">\
				<li class="media">\
				<img class="mr-3 thread_image" src="/'+data.image+'" alt="User Image" onerror="'+dummy_image+'">\
				<div class="media-body col-9 mt-3">\
				<h5 class="mt-0 mb-4">'+data.username+'</h5>\
				<div class="comment_content mb-4" id="comment'+data.id+'">'+data.content+'</div>\
				</div>\
				<div class="media-body col-3 mt-3 text-right">\
				<p class="comment_time" id="time'+data.id+'">'+data.date_created+'</p>\
				</div></li><hr><div class="row">\
				<div class="col-md-12 text-right pr-4 mb-5">\
				<i data-id="'+data.id+'" class="fas fa-edit mr-2 comment_edit_image"></i>\
				<i class="fas fa-trash mr-2 trash" data-id="'+data.id+'"></i>\
				<i class="fas fa-flag flag" data-id="'+data.id+'"  id="flag'+data.id+'"></i></div></div></ul>');
			
			$('textarea#thread_content').val('  ');
		}
	})
})

$(document).on('click', 'i.comment_edit_image', function(){
	let id = $(this).data('id');
	let content = $.trim($(this).parents().find('ul#' + id).find('.media-body').find('.comment_content').text());
	let modal= $('#comment_edit').find('.modal-content').find('.modal-body').find('.richText-editor').html(content)
	let button= $('#comment_edit').find('.modal-content').find('.modal-footer').find('button.comment_update').attr('data-id', id)
	console.log(content)

	$('#comment_edit').modal('show')

})

$('i#edit_image').click(function() {

	let id = $('i#edit_image').data('id');
	
	$.ajax({
		url: '/forum/'+ id+ '/edit',
		method: 'post', 
		data: {
			id:id
		},
		success:function(data) {
			$('#edit').modal('show');
		}
	})
})

$('button.comment_update').click(function(){
	let id = $(this).attr('data-id');
	let content = $(this).parent().parent().find('.modal-body').find('.container').find('.richText-editor').text();

	$.ajax({
		url: '/comments/' + id,
		method: 'post',
		data: {
		    _method : 'patch',
			id:id,
			content:content
		},
		success:function(data){
			$('div#comment' + id).html(data.content);
			$('p#time' + id).html(data.updated);
			$('#comment_edit').modal('hide');
		}
	})
})


$(document).on('click', 'i.trash', function(){
	let id = $(this).data('id');
	let button= $('#comment_delete').find('.modal-content').find('.modal-footer').find('button.comment_delete').attr('data-id', id) 

	$('#comment_delete').modal('show')
})



$(document).on("click", "button.comment_delete", function(){

	let id = $(this).attr('data-id')
	// console.log(id)

	$.ajax({
		url: '/comments/' + id,
		method: 'post',
		data: {
			id:id,
			_method : 'delete'
		},
		success:function(data){
			$('ul#' + data).fadeOut();
			$('#comment_delete').modal('hide');
		}
	})

})




$('button#update_thread').click(function() {

	let id = $('button#update_thread').data('id');
	let title = $('input#edit_subject').val();
	let content = $('textarea#thread').val();

	$.ajax({
		url: "/forum/" + id,
		method: 'post', 
		async: 'false',
		data: {
		    _method : 'patch',
			id:id,
			title:title,
			content:content
		},
		success:function(data) {
			$('#topic_subject').text(data.subject);
			$('ul#'+ id).find('div').find('div.content').html(data.content);
			$('p.thread_time').html(data.updated);
			$('#edit').modal('hide');
		}
	})
})


$('button#thread_delete').click(function(){
	let id= $('button#thread_delete').data('id');

	$.ajax({
		url: '/thread/' + id,
		method: 'post',
		data: {
		    _method : 'delete',
			id:id
		},
		success:function(data){
			$('#delete').modal('hide');
			$('ul#'+ data).remove();
			$('ul.replies').remove();
			$('h2#topic_subject').html(' ');
			$('.reply_container').remove();
			$('div.deleted_thread').append('<div class="alert alert-danger" role="alert">Your Thread was successfully deleted!</div>')
			$('div.deleted_thread').append('<h3>Please go back to the Forum Page and post another thread. </h3>')
		}
	})
})


$('span#search_bar').click(function(){
	let content = $('input#search_area').val();
	let id = $('input#search_area').data('id');

	$.ajax({
		url: '/search',
		method: 'POST',
		async: false,
		data: {
			content:content,
			id:id
		},
		success:function(data){
            $('tbody').hide();
            
			for (let i =0; i<data.length; i++) {
				let value = data[i];
				let id = value.id;
				let subject = value.subject;
				
				$('tbody#'+ id).show();
			}
		}
	})
})

$('button#show').click(function(){
	$('tbody').show();
})

$(document).on('click', 'i#thread_flag', function(){
	$('#report').modal('show');
})


$('button#report_thread').click(function(){

	let id = $(this).data('id');
	let content= $('textarea#report_thread').val();

	$.ajax({
		url: "/reports/" +id,
		method: "post",
		data: {
			id:id,
			content:content
		},
		success:function(data){
			// console.log(data)
			$('#report').modal('hide');
			$('.flag_message').append('<div class="alert alert-danger" role="alert">Thread was successfully reported. The support team will review the complaint for further notice and apply appropriate measures. </div>');
			$('i#thread_flag').css('color', 'red');
			$('textarea#report_thread').val(' ');
		}
	})
})


$(document).on('click', 'i.flag', function(){
	let id = $(this).data('id')
	
	$('.modal-header.comment_flag').attr('id', id);
	$('#report_comment').modal('show')
})


$('button.comment_flag').on("click", function(){

	let content = $('textarea#commentflag_content').val();
	let comment_id = $(this).closest('div').prev().prev().attr('id');
	let thread_id = $(this).attr('data-id');
	
	$.ajax({
		url: "/comment_reports/" + comment_id,
		method: 'post',
		data: {
			content:content,
			comment_id:comment_id,
			thread_id:thread_id
		},
		success:function(data){
			$('#report_comment').modal('hide');
			$('.comment_report').append('<div class="alert alert-danger" role="alert">Comment was successfully reported. The support team will review the complaint for further notice and apply appropriate measures. </div>');
			$('#flag'+ data ).css('color', 'red');
			$('textarea#commentflag_content').val(' ');		
		}
	})
})


$('i#like').click(function(){
	let id = $(this).data('id');

	$.ajax({
		url: '/' +id+ '/like',
		method: 'post',
		data: {
			id:id
		},
		success:function(data){
			// console.log(data)
			$('i#like').css('color', 'red');
		}
	})
})

$('i#unlike').click(function(){
	let id = $(this).data('id');

	$.ajax({
		url: '/' +id+ '/unlike',
		method: 'post',
		data: {
			id:id
		},
		success:function(data){
			// console.log(data)
			$('i#unlike').css('color', 'black');
		}
	})
})

$(document).on('click', '.btn-remove', function(){
	let id= $(this).data('id');
	let button= $('#remove').find('.modal-content').find('.modal-footer').find('button.remove_list').attr('data-id', id) 

	$('#remove').modal('show')
	
})

$(document).on("click", "button.remove_list", function(){

	let id = $(this).attr('data-id')
	// console.log(id)

	$.ajax({
		url: '/categories/' + id,
		method: 'post',
		data: {
		   _method : 'delete',
			id:id
		},
		success:function(data){
			$('div#cat' + data).fadeOut();
			$('#remove').modal('hide');
		}
	})

})

$(document).on('click', '.btn-edit', function(){
	let id= $(this).data('id');
	let data = $.trim($(this).closest('.card').find('.card-header').text());
	let modal= $('#edit_category').find('.modal-body').find('input#category').val(data) 
	let button= $('#edit_category').find('.modal-content').find('.modal-footer').find('button.edit_list').attr('data-id', id) 

	$('#edit_category').modal('show')
	
})

$(document).on('click', 'button.edit_list', function(){
	let id = $('button.edit_list').attr('data-id');
	let content = $(this).parent().parent().find('.modal-body').find('input#category').val()

	$.ajax({
		url: '/categories/'+ id,
		method: 'post', 
		data: {
		    _method : 'patch',
			id:id,
			content:content
		},
		success:function(data) {
			$('div#head' + id).html(data.title);
			$('#edit_category').modal('hide')

		}
	})
})

$('button.comment_update').click(function(){
	let id = $(this).attr('data-id')
	let content = $(this).parent().parent().find('.modal-body').find('.container').find('.richText-editor').text()

	$.ajax({
		url: '/comments/' + id,
		method: 'post',
		data: {
		    _method : 'patch',
			id:id,
			content:content
		},
		success:function(data){
			// console.log(data)
			$('div#comment' + id).html(data.content);
			$('p#time' + id).html(data.updated);
			$('#comment_edit').modal('hide')
		}
	})
})

$('input#search_thread').on('keyup', function(){
	let search = $(this).val();

	$.ajax({
		type: 'get',
		url: '/search',
		data: { search :search},
		success:function(data){
			// console.log(data)
			$('tbody').html(data);
		}
	})
})

$(document).on('click', 'button.reported_thread', function(){
	let id = $(this).data('id');
	let button= $('#reported_flagthread').find('.modal-content').find('.modal-footer').find('button.report_thread').attr('data-id', id) 

	$('#reported_flagthread').modal('show')
})



$(document).on("click", "button.report_thread", function(){

	let id = $(this).attr('data-id')
	// console.log(id)

	$.ajax({
		url: '/reports/' + id,
		method: 'delete',
		data: {
			id:id
		},
		success:function(data){
			$('td#' + data).fadeOut();
			$('#reported_flagthread').modal('hide');
		}
	})

})
