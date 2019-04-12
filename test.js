// TODO: can an ajax loaded page fire an event?2

$(document).ready(function(){
  $("input[type=checkbox]").change(function(){
    console.log(this.checked);
    var checked = [];
    $("input[type=checkbox][name=grade]:checked").each(function(){
      checked.push($(this).val());
    });

    if(checked.length > 0){
      $.ajax({
        type: "post",
        url: "getSection.php",
        data: { gradeLevel: checked },
        success: function(data){
          $('div[name=section-content]').html(data);
        }
      });
    }else{
      $('div[name=section-content]').html("");
    }
  });

  $(document).on("change", "input.section", function(){
    console.log($(this).val());
  });
})
