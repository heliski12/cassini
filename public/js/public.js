$(function(){
  $(document).on('submit','#signup_form', function(event) {
    event.preventDefault();
    $("button[type=submit]").addClass('disabled');
    $.post(BASE_URL + '/signup', 
      $(this).serialize(),
      function(data, textStatus, request) {
        $('#signup_modal_content').html(data);
    });
  });
  $(document).on('submit','#password_reminder_form', function(event) {
    event.preventDefault();
    $.post($(this).attr('action'), 
      $(this).serialize(),
      function(data, textStatus, request) {
        $('#forgot_password_modal_content').html(data);
    });
  });

  if (window.location.hash != undefined && (window.location.hash == '#s' || window.location.hash == '#s2')) {
      $("#user_signup").modal();
  }
});



