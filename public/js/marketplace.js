var tm_count = 0;
var photo_count = 1;
var presentation_count = 0;
var publication_count = 0;
var award_count = 0;
$(function(){
  ///////// create profile form /////////
  $("#create_profile_form").on('click','[data-toggle=collapse]', function(event) {
    $(this).children("span").toggleClass("glyphicon-chevron-up");
    $(this).children("span").toggleClass("glyphicon-chevron-down");
  });
  $("a.add-another-kp").click(function(event) {
    event.preventDefault();
    var extra_keyperson = $("#extra_keyperson .panel")
              .html()
              .replace(new RegExp("\\{x\\}","g"), ++tm_count)
              .replace(new RegExp("\\[0\\]","g"), "["+tm_count+"]");
    $("#kp_accordion").append(extra_keyperson);
  });
  $("a.add-another-photo").click(function(event) {
    event.preventDefault();
    if (photo_count >= 4)
      return;
    var extra_photo = $("#extra_photo")
              .html()
              .replace(new RegExp("Photo 1","g"), "Photo " + ++photo_count)
              .replace(new RegExp("\\[0\\]","g"), "["+photo_count+"]");
    $("#photos_list").append(extra_photo);
  });
  $("a.add-another-presentation").click(function(event) {
    event.preventDefault();
    var extra_presentation = $("#extra_presentation")
              .html()
              .replace(new RegExp("\\[0\\]","g"), "["+ ++presentation_count+"]");
    $("#presentations_list").append(extra_presentation);
  });
  $("a.add-another-publication").click(function(event) {
    event.preventDefault();
    var extra_publication = $("#extra_publication")
              .html()
              .replace(new RegExp("\\[0\\]","g"), "["+ ++publication_count+"]");
    $("#publications_list").append(extra_publication);
  });
  $("a.add-another-award").click(function(event) {
    event.preventDefault();
    var extra_award = $("#extra_award")
              .html()
              .replace(new RegExp("\\[0\\]","g"), "["+ ++award_count+"]");
    $("#awards_list").append(extra_award);
  });
  $("button#upload_video").click(function(event) {
    event.preventDefault();
    alert("Video uploads are coming soon!");
  });

  $(".innovator-type-extras").collapse({toggle:false});
  $("input[name=innovator_type]").change(function(event) {
    if ($(this).val() == 'entrepreneur')
    {
      $("#researcher").collapse('hide');
      $("#entrepreneur").collapse('show');
    }
    else
    {
      $("#entrepreneur").collapse('hide');
      $("#researcher").collapse('show');
    }
  });

  // technology description character count
  var max_chars = 1550;
  var used_chars = 0;
  $('#tech_description_charcount').html(used_chars + '/' + max_chars);

  $('#tech_description').keyup(function() {
      var text = $('#tech_description').val();
      var matches = text.match(/\n/g);
      var breaks = matches ? matches.length : 0;
      var used_chars = text.length + breaks;

      $('#tech_description_charcount').html(used_chars + '/' +  max_chars);
  });
  ///////// create profile form /////////

  $('.selectpicker').selectpicker({ dropupAuto: false, size: 9, selectedTextFormat: 'count > 5' });
  
  
});


