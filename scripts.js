$(document).ready(function(){
  $("input[type=button][name=submit]").click(function(){
    update();
  });

  // $("input[type=checkbox][name=date]").change(function(){
  //   var date = $(this).val();
  //   console.log(date);
  // });
  //
  // $("input[type=checkbox][name=grade]").change(function(){
  //   var grade = $(this).val();
  //   console.log(grade);
  //
  // });
  //
  // $("input[type=checkbox][name=section]").change(function(){
  //   var section = $(this).val();
  //   console.log(section);
  //
  // });

  function update(){
    var date = [];
    var grade = [];
    var section = [];

    $("input[type=radio][name=date]:checked").each(function(){
      var val = $(this).val();
      date.push(val);
    });
    $("input[type=checkbox][name=grade]:checked").each(function(){
      grade.push($(this).val());
    });
    $("input[type=checkbox][name=section]:checked").each(function(){
      section.push($(this).val());
    });

    var sDate;
    var sGrade;
    var sSection;
    sDate = date.join(",");
    sGrade = grade.join(",");
    sSection = section.join(",");

    console.log(sGrade);
    if(date.length > 0 && grade.length > 0 && section.length > 0){
      $.ajax({
        type: "post",
        url: "attendance.php",
        data: {
          date: sDate,
          grade: sGrade,
          section: sSection
        },
        success: function(data){
          $(".content").html(data);
        }
      })
    }
  }
});
