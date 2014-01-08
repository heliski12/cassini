$(function(){
  $(document).on('submit','#signup_form', function(event) {
    event.preventDefault();
    $("button[type=submit]").addClass('disabled');
    $.post(BASE_URL + '/signup', 
      $(this).serialize(),
      function(data, textStatus, request) {
        // TODO - needed if want to forward to pending authorization page
        //if (request.getResponseHeader('signup')) 
          //document.location = BASE_URL + '/authorization';
        //else
          $('#signup_modal_content').html(data);
    });
  });
});

$(document).ready(function() {
			$.fn.fullpage({
        slidesColor: ['#FFFFF','#18698B','#506227']
			});
		});


