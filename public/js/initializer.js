$(document).ready(function(){
$(".bwWrapper").BlackAndWhite({
        hoverEffect : true, // default true
        // set the path to BnWWorker.js for a superfast implementation
        webworkerPath : false,
        // to invert the hover effect
        invertHoverEffect: false,
        // this option works only on the modern browsers ( on IE lower than 9 it remains always 1)
        intensity:1,
        speed: { //this property could also be just speed: value for both fadeIn and fadeOut
            fadeIn: 200, // 200ms for fadeIn animations
            fadeOut: 800 // 800ms for fadeOut animations
        },
        onImageReady:function(img) {
            // this callback gets executed anytime an image is converted
        }
    });
});

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

  if (window.location.hash != undefined && (window.location.hash == '#s' || window.location.hash == '#s2')) {
      $("#user_signup").modal();
  }
});
