var icons = false;

// $(".row").hover(function () {
//   console.log("asd");
//   if (icons == false) {
//     $(this).children('.icons').css('visibility', 'visible');
//   } else {
//     $('.icons').css('visibility', 'hidden');
//   }
//   icons = !icons;
// }
// );

// $(".row").mouseenter(function () {
//   console.log("asd");
//   if (icons == false) {
//     $(this).children('.icons').css('visibility', 'visible');
//   } else {
//     $('.icons').css('visibility', 'hidden');
//   }
//   icons = !icons;
// });
function logout() {
  console.log("izlogovan");
  $.get("logout.php", function () {
    window.location = "login.php";
  });
}

/*Delete user*/
function deleteUser(username) {
  $.ajax({
    url: "http://localhost/sudoku/back-end/user/" + username,
    type: 'DELETE',
    success: function (result) {
      console.log(result);
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

function getAllUsers(id) {
  $.ajax({
    url: "http://localhost/sudoku/back-end/users",
    type: 'GET',
    success: function (result) {
      result.forEach((element, i) => {
        if(element.id == id){
          $( ".allusers ul" ).append( "<li class='row'><em>" + (i+1) + "</em><em>"+ element.user_name +"</em><em>"+ element.name +"</em><em>"+ element.lastname 
          +"</em><em class='icons'><i class='fas fa-pencil-alt' onclick='editUser(\"" + element.id+ "\")'></i></em></li>" );
        }else{
          $( ".allusers ul" ).append( "<li class='row'><em>" + (i+1) + "</em><em>"+ element.user_name +"</em><em>"+ element.name +"</em><em>"+ element.lastname 
           +"</em><em class='icons'><i class='fas fa-trash-alt' onclick='deleteUser(\"" + element.user_name + 
            "\")'></i>&nbsp;<i class='fas fa-pencil-alt' onclick='editUser(\"" + element.id+ "\")'></i></em></li>" );
        }
      });
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