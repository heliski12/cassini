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
  $(document).on('submit','#password_reminder_form', function(event) {
    event.preventDefault();
    $.post($(this).attr('action'), 
      $(this).serialize(),
      function(data, textStatus, request) {
        $('#forgot_password_modal_content').html(data);
    });
  });
});

$(document).ready(function() {
  $(".main").onepage_scroll({
      sectionContainer: "div.section"
  });
  $("a#scroll_down").click(function(event) {
    event.preventDefault();
    $(".main").moveDown();
  });
});


