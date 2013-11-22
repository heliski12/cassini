$(function(){
  $(document).on('submit','#signup_form', function(event) {
    event.preventDefault();
    $("button[type=submit]").addClass('disabled');
    $.post(BASE_URL + '/signup', 
      $(this).serialize(),
      function(data, textStatus, request) {
        if (request.getResponseHeader('signup')) 
          document.location = BASE_URL + '/authorization';
        else
          $('#signup_modal_content').html(data);
    });
  });
});

