var tm_count = 0;
$(function(){
  $("#create_profile_form").on('click','[data-toggle=collapse]', function(event) {
    $(this).children("span").toggleClass("glyphicon-chevron-up");
    $(this).children("span").toggleClass("glyphicon-chevron-down");
  });
  $("a.add-another").click(function(event) {
    event.preventDefault();
    var extra_keyperson = $("#extra_keyperson .panel")
              .html()
              .replace(new RegExp("\\{x\\}","g"), ++tm_count)
              .replace(new RegExp("\\[0\\]","g"), "["+tm_count+"]");
    $("#kp_accordion").append(extra_keyperson);
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

  $('.selectpicker').selectpicker({ dropupAuto: false, size: 9, selectedTextFormat: 'count > 5' });
  
});


