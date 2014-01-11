$(function(){
  ///////// create profile form /////////
  $("#create_profile_form").on('click','[data-toggle=collapse]', function(event) {
    $(this).children("span").toggleClass("glyphicon-chevron-up");
    $(this).children("span").toggleClass("glyphicon-chevron-down");
    $(".glyphicon-chevron-up").attr("title","Collapse view");
    $(".glyphicon-chevron-down").attr("title","Expand view");
  });
  $("#create_profile_form").on('click','a.remove-tm', function(event) {
    event.preventDefault();
    var remove_selector = ".kp" + $(this).attr('id').substring(10);
    $(remove_selector).remove(); 
  });
  $("a.add-another-kp").click(function(event) {
    event.preventDefault();
    var extra_keyperson = $("#extra_keyperson .panel")
              .html()
              .replace(new RegExp("\\[x\\]","g"), ++counts.tm_count)
              .replace(new RegExp("\\[0\\]","g"), "["+counts.tm_count+"]");
              console.log(extra_keyperson);
    $("#kp_accordion").append(extra_keyperson);
  });
  $("a.add-another-photo").click(function(event) {
    event.preventDefault();
    if (counts.photo_count >= 4)
      return;
    var extra_photo = $("#extra_photo")
              .html()
              .replace(new RegExp("\\[x\\]","g"), ++counts.photo_count)
              .replace(new RegExp("\\[0\\]","g"), counts.photo_count);
    $("#photos_list").append(extra_photo);
  });
  $("#create_profile_form").on('click','a.remove-presentation', function(event) {
    event.preventDefault();
    var remove_selector = ".presentation" + $(this).attr('id').substring(20);
    $(remove_selector).remove(); 
  });
  $("a.add-another-presentation").click(function(event) {
    event.preventDefault();
    var extra_presentation = $("#extra_presentation")
              .html()
              .replace(new RegExp("\\[x\\]","g"), ++counts.presentation_count);
    $("#presentations_list").append(extra_presentation);
  });
  $("#create_profile_form").on('click','a.remove-publication', function(event) {
    event.preventDefault();
    var remove_selector = ".publication" + $(this).attr('id').substring(19);
    $(remove_selector).remove(); 
  });
  $("a.add-another-publication").click(function(event) {
    event.preventDefault();
    var extra_publication = $("#extra_publication")
              .html()
              .replace(new RegExp("\\[x\\]","g"), ++counts.publication_count);
    $("#publications_list").append(extra_publication);
    $(".publication"+counts.publication_count+" .selectpicker-extra").selectpicker({ dropupAuto: false, size: 9, selectedTextFormat: 'count > 5' });
  });
  $("#create_profile_form").on('click','a.remove-award', function(event) {
    event.preventDefault();
    var remove_selector = ".award" + $(this).attr('id').substring(13);
    $(remove_selector).remove(); 
  });
  $("a.add-another-award").click(function(event) {
    event.preventDefault();
    var extra_award = $("#extra_award")
              .html()
              .replace(new RegExp("\\[x\\]","g"), ++counts.award_count);
    $("#awards_list").append(extra_award);
  });
  $("a.add-fs-additional").click(function(event) {
    event.preventDefault();
    $(".fs-additional").show();
  });
  $("button#upload_video").click(function(event) {
    event.preventDefault();
    if (typeof _gaq !== 'undefined') {
      _gaq.push(['_trackEvent', 'VIDEO UPLOAD','BUTTON CLICKED','Button Click']);
    }
    alert("Video uploads are coming soon!");
  });
  $("input[type=checkbox]").change(function(event) {
    if ($(this).is(":checked"))
      $("input#submit_profile").removeClass('disabled');
    else
      $("input#submit_profile").addClass('disabled');
  });
  $("#clicker").click(function(event) {
    var checked = $("input[type=checkbox]").is(":checked"); 
    if (!checked)
      alert("You must agree to the Terms of Service before submitting your profile.");
    return;
  });
  if (typeof($("#market_applications").tagit) != "undefined") {
    $('#market_applications').tagit({
        allowSpaces: true,
        fieldName: 'market_applications[]'
    });
  }
  if (typeof($(".selectpicker").selectpicker) != 'undefined') {
    $('.selectpicker').selectpicker({ dropupAuto: false, size: 9, selectedTextFormat: 'count > 5' });
  }

  //////// my profile ///////////////
  $(".add-editor-form").submit(function(event) {
    event.preventDefault();
    //var profile_id = $($(this).find('input[name=profile_id]')[0]).val();
    //var email = $($(this).find('input[name=email]')[0]).val();
    var $this = $(this);
    $.post(BASE_URL + '/add-editor', 
      $(this).serialize(),
      function(data) {
        $this.prev('span.secondary-editors').html(data);
        $this.find('input[name=email]').val('');
    });
  });
  $("span.secondary-editors").on('click','.remove-se', function(event) {
    event.preventDefault();
    var profile_id = $(this).attr('pid');
    var user_id = $(this).attr('uid');
    var $this = $(this);
    $.post(BASE_URL + '/remove-editor',
      { profile_id : profile_id,
        user_id : user_id },
      function(data) {
        $this.parent().html(data);
    });
  });
  $("div.saved-profile-controls").on('click','.remove-sp', function(event) {
    event.preventDefault();
    var profile_id = $(this).attr('pid');
    var $this = $(this);
    $.post(BASE_URL + '/remove-saved-profile',
      { profile_id : profile_id },
      function(data) {
        $this.closest('.my-profile').remove();
    });
  });
  $(".saved-profile-contact").click(function(event) {
    var selected = $(".contact-select:checked");
    var text = "";
    var profile_ids = "";
    for (var i = 0; i < selected.length; i++)
    {
      var selected_id = $(selected[i]).attr('id');
      var selected_title = $("#name_"+selected_id).val();
      text = text + "<li>" + selected_title + "</li>";
      profile_ids = profile_ids + selected_id + ",";
    }
    $("#profile_ids").val(profile_ids);
    $("#message_profiles").html(text);
  });

  /////// search ////////
  $(".marketplace").on('click','[data-toggle=collapse]', function(event) {
    $(this).children("span").toggleClass("glyphicon-chevron-up");
    $(this).children("span").toggleClass("glyphicon-chevron-down");
    $(".glyphicon-chevron-up").attr("title","Collapse view");
    $(".glyphicon-chevron-down").attr("title","Expand view");
  });
  $("#clear_fields").click(function(event) {
    event.preventDefault();
    $("input[name=q]").val("");
    $(".selectpicker").selectpicker("deselectAll");
  });
  
  // initialize open/close state of innovator type based on previous model value
  var innovator_type = $("input[name=innovator_type][checked]").val();
  if (innovator_type && innovator_type == 'ENTREPRENEUR')
  {
    $("#entrepreneur").collapse('show');
  }
  else if (innovator_type && innovator_type == 'RESEARCHER')
  {
    $("#researcher").collapse('show');
  }
  $(".innovator-type-extras").collapse({toggle:false});
  $("input[name=innovator_type]").change(function(event) {
    if ($(this).val() == 'ENTREPRENEUR')
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

  if (typeof($("#photo-carousel").carousel) != 'undefined') {
    $("#photo-carousel").carousel({ });
  }

  $("a.carousel-thumb").click(function(event) {
    event.preventDefault();
    var associate = $($(this).attr('lg'));
    $("#photo_main_img").attr('src',associate.attr('src'));
    $("#photo_main_img").attr('alt',associate.attr('alt'));
    $("#photo_main_desc").html(associate.attr('alt'));
  });
  
  
});


