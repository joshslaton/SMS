$(document).ready(function(){
  $('#nav-home').on("click", function(){
    $('#nav-sub').html(
      "<li><a href='#'>Announcements</a></li> \
      <li><a href='#'>About</a></li>"
    );
    $('#nav-home').css("background-color","green");
    $('#nav-home a').css("color","white");
    $('#nav-students').css("background-color","white");
    $('#nav-students a').css("color","black");
    $('#nav-reports').css("background-color","white");
    $('#nav-reports a').css("color","black");

  });

  $('#nav-students').on("click", function(){
    $('#nav-sub').html(
      "<li><a href='#'>Student Info</a></li> \
      <li><a href='#'>Add Student</a></li>"
    );
    $('#nav-home').css("background-color","white");
    $('#nav-home a').css("color","black");
    $('#nav-students').css("background-color","green");
    $('#nav-students a').css("color","white");
    $('#nav-reports').css("background-color","white");
    $('#nav-reports a').css("color","black");

  });

  $('#nav-reports').on("click", function(){
    $('#nav-sub').html(
      "<li><a href='#'>None</a></li>"
    );
    $('#nav-home').css("background-color","white");
    $('#nav-home a').css("color","black");
    $('#nav-students').css("background-color","white");
    $('#nav-students a').css("color","black");
    $('#nav-reports').css("background-color","green");
    $('#nav-reports a').css("color","white");

  });
})
