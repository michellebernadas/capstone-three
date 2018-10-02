$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

});

AOS.init();
$('.ml3').each(function(){
  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
});

anime.timeline({loop: true})
  .add({
    targets: '.ml3 .letter',
    opacity: [0,1],
    easing: "easeInOutQuad",
    duration: 900,
    delay: function(el, i) {
      return 150 * (i+1)
    }
  }).add({
    targets: '.ml3',
    opacity: 0,
    duration: 2000,
    easing: "easeOutExpo",
    delay: 900
  });

anime.timeline({loop: true})
  .add({
    targets: '.ml15 .word',
    scale: [14,1],
    opacity: [0,1],
    easing: "easeOutCirc",
    duration: 2000,
    delay: function(el, i) {
      return 1000 * i;
    }
  }).add({
    targets: '.ml15',
    opacity: 0,
    duration: 3000,
    easing: "easeOutExpo",
    delay: 3000
  });

$(window).scroll(function() {
  if ($(document).scrollTop() > 50) {
    $('nav').addClass('shrink');
  } else {
    $('nav').removeClass('shrink');
  }
});

$('.dropdown').on('show.bs.dropdown', function(e){
  var $dropdown = $(this).find('.dropdown-menu');
  var orig_margin_top = parseInt($dropdown.css('margin-top'));
  $dropdown.css({'margin-top': (orig_margin_top + 20) + 'px', opacity: 0}).animate({'margin-top': orig_margin_top + 'px', opacity: 1}, 300, function(){
     $(this).css({'margin-top':''});
  });
});

$('.dropdown').on('hide.bs.dropdown', function(e){
  var $dropdown = $(this).find('.dropdown-menu');
  var orig_margin_top = parseInt($dropdown.css('margin-top'));
  $dropdown.css({'margin-top': orig_margin_top + 'px', opacity: 1, display: 'block'}).animate({'margin-top': (orig_margin_top + 20) + 'px', opacity: 0}, 300, function(){
     $(this).css({'margin-top':'', display:''});
  });
});

$('input#image').change(function(event) {
	let imagepath = URL.createObjectURL(event.target.files[0]);
	$('.image-holder').append('<img src="'+imagepath+'">');
	let imageLength = $(this).closest('form').find('.image-holder').find('img').length;

	if(imageLength==2){
	    $(this).closest('form').find('.image-holder').find('img').prev().remove();
	}
})

$('button#update').click(function() {

    let id= $('button#update').data('id');
    let first_name = $('input#first_name').val();
    let last_name = $('input#last_name').val();
    let email = $('input#email').val();
    let username = $('input#username').val();

    $.ajax({
      url: '/user/edit/'+ id,
      method: 'post',
      data:{
         _method: 'patch',
        id:id,
        first_name:first_name,
        last_name:last_name,
        email:email,
        username:username
      },
      success:function(data) {
        console.log(data)
       alertify.notify('Your account has been updated Successfully', 'success', 5, function(){  console.log('dismissed'); });
        // $('.success_message').append('<div class=" alert alert-success">Your account has been updated Successfully!</div>');
        $('#prof_username').text(data.username);
        $('span#first_name').text(data.first_name);
        $('span#last_name').text(data.last_name);
        $('span#email').text(data.email);

      }

    })
})

$('form#register').submit(function(e){
  e.preventDefault();

  let form = new FormData(this);
  
  $.ajax({
    url:'/register',
    method: 'POST',
    contentType: false,
    processData: false,
    cache: false,
    data: form ,
    success:function(data){
    },
    error:function(errors){
      let msg_error = errors.responseJSON.errors;
      for (var keys in msg_error) {
        alertify.notify(msg_error[keys][0], 'success', 5, function(){  console.log('dismissed'); })
      }
      if (!msg_error) {
        location.reload();
      }
    }

  })
})

$(document).on("click", "button.deactivate", function(){

  let id = $(this).attr('data-id');

  $.ajax({
    url: '/user/deactivate/' + id,
    method: 'post',
    data: {
        _method: 'delete',
        id:id
    },
    success:function(data){
      location.reload()

      alertify.notify('User Deactivated Successfully', 'success', 5, function(){  console.log('dismissed'); });
    }
  })

})