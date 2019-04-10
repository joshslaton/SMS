$(document).ready(function(){
  $('input:checkbox').change(function(){
    if(this.checked){
      var grade = [];
      $('input[type=checkbox][id=grade]:checked').each(function(){
        grade.push($(this).val());

      });
      if(grade.length > 0){
        $.ajax({
          type: 'post',
          url: 'test.php',
          data: {
            grade: grade
          },
          success: function(data){
            $('body').html(data);
            $('input[type=checkbox][id=section]').prop("checked");
          }
        })
      }
    }
  });

})
