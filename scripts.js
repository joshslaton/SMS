// TODO: can an ajax loaded page fire an event?2

$(document).ready(function(){
  var dateArray = [];
  var gradeArray = [];
  var sectionArray = [];
  var genderArray = [];
  $(document).on("change", "input[type=checkbox], input[type=radio]", function(){

    $("input[type=radio][name=date]:checked").each(function(){
      dateArray.push($(this).val());
    });
    $("input[type=radio][name=grade]:checked").each(function(){
      gradeArray.push($(this).val());
    });
    $("input[type=radio][name=section]:checked").each(function(){
      sectionArray.push($(this).val());
    });
    $("input[type=checkbox][name=gender]:checked").each(function(){
      genderArray.push($(this).val());
    });

    if(dateArray.length > 0 && gradeArray.length > 0 && sectionArray.length > 0 && genderArray.length > 0){
      console.clear();
      // console.table({dateArray, gradeArray, sectionArray, genderArray});
      var date;
      var grade;
      var section;
      date = dateArray.join("");
      grade = gradeArray.join("");
      section = sectionArray.join("");
      gender = genderArray.join("");
      // console.table({date, grade, section});
      $.ajax({
        type: "post",
        url: "attendance.php",
        data: {
          date: date,
          grade: grade,
          sec: section,
          gender: gender
        },
        success: function(data){
          $("div.content").html(data);
        }
      })
    }
    reset();
  });

  function reset(){
    dateArray.length = 0;
    gradeArray.length = 0;
    sectionArray.length = 0;
    genderArray.length = 0;
  }
})
