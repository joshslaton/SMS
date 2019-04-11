// TODO: can an ajax loaded page fire an event?

$(document).ready(function(){
  $("input[type=checkbox]").change(function(){
    console.table($(this).val());
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

  $("input[type=checkbox][name=section]").change(function(){
    console.log("section changed");
  });
})
