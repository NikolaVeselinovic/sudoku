var icons = false;


$(".target").change(function () {
  alert("Handler for .change() called.");
});

function logout() {
  console.log("izlogovan");
  $.get("logout.php", function () {
    window.location = "login.php";
  });
}

/*Delete user*/
function deleteUser(id, username) {
  $.ajax({
    url: "http://localhost/sudoku/back-end/user/" + username,
    type: 'DELETE',
    success: function (result) {
      console.log(result);
      getAllUsers(id,  $('#search').val());
    },
    error: function (result) {
      console.log(result);
    }
  });
}

/*Edit user */
function editUser(id) {
  window.location.href = "edit-profile.php?id=" + id;
}

function getAllUsers(id, key) {
  $('.allusers ul').find("li").slice(2).remove();
  $.ajax({
    url: "http://localhost/sudoku/back-end/users?key=" + key,
    type: 'GET',
    success: function (result) {
      if ($.isArray(result)) {
        result.forEach((element, i) => {
          if (element.id == id) {
            $(".allusers ul").append("<li class='row'><em>" + (i + 1) + "</em><em>" + element.user_name + "</em><em>" + element.name + "</em><em>" + element.lastname
              + "</em><em class='icons'><i class='fas fa-pencil-alt' onclick='editUser(\"" + element.id + "\")'></i></em></li>");
          } else {
            $(".allusers ul").append("<li class='row'><em>" + (i + 1) + "</em><em>" + element.user_name + "</em><em>" + element.name + "</em><em>" + element.lastname
              + "</em><em class='icons'><i class='fas fa-trash-alt' onclick='deleteUser(\""+ id +"\",\"" + element.user_name +
              "\")'></i>&nbsp;<i class='fas fa-pencil-alt' onclick='editUser(\"" + element.id + "\")'></i></em></li>");
          }
        });
      }

      $(".row").hover(function () {
        if (icons == false) {
          $(this).children('.icons').css('visibility', 'visible');
        } else {
          $('.icons').css('visibility', 'hidden');
        }
        icons = !icons;
      }
      );
    },
    error: function (result) {
      console.log(result);
    }
  });
}
function sort(desc) {
  $('.rank ul').find("li").slice(1).remove();
  if(desc==1){
    $('.rank ul .icons i:first-child').css('color','rgb(16, 60, 86)');
    $('.rank ul .icons i:last-child').css('color','rgb(237, 241, 247)');
  }else{
    $('.rank ul .icons i:last-child').css('color','rgb(16, 60, 86)');
    $('.rank ul .icons i:first-child').css('color','rgb(237, 241, 247)');
  }
  $.ajax({
    url: "http://localhost/sudoku/back-end/results?desc="+desc,
    type: 'GET',
    success: function (result) {
      result.forEach((element, i) => {
          $( ".rank ul" ).append( "<li class='row'><em>" + (i+1) + "</em><em>"+ element.user_name +"</em><em>"+ element.name +"</em><em>"+ element.lastname +"</em><em>"+ element.timeInSeconds +"</em><em></em></li>" );

      });
    },
    error: function (result) {
      console.log(result);
    }
  });
}
