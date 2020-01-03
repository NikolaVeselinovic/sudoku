var icons = false;

$( ".row" ).hover( function(){
  if (icons == false) {
    $(this).children('.icons').css('visibility', 'visible');
  } else {
    $('.icons').css('visibility', 'hidden');
  }
  icons=!icons;
}
);
function logout() {
  console.log("izlogovan");
  $.get("logout.php", function () {
      window.location = "login.php";
    });
}








/*Delete user*/
function deleteUser(username) {
    $.ajax({
      url: "http://localhost/sudoku/back-end/user/"+username,
      type: 'DELETE',
      success: function(result) {
          console.log(result);
      },
      error:  function(result) {
        console.log(result);
    }
  });
}

/*Edit user */
function editUser(id) {
  window.location.href = "edit-profile.php?id="+id;
}

// /*Sort ranking list ASC*/
// function sortASC() {
//   // console.log("http://localhost/sudoku/back-end/users?user_name="+user_name+"&name="+name+"&lastname="+lastname);
//   $.ajax({
//     url: "http://localhost/sudoku/back-end/results",
//     type: 'GET',
//     success: function (result) {
//       result.forEach((element, i) => {
//    //sve moje lijeve iz phpa
//           $( ".rank ul" ).append( "<li class='row'><em>" + (i+1) + "</em><em>"+ element.user_name +"</em><em>"+ element.name +"</em><em>"+ element.lastname +"</em><em>"+ element.score +"</em><em class='icons'>"+<i class="fas fa-sort-up" onclick="sortASC(1)"></i>+"</em></li>" );
       
//       });
//     },
//     error: function (result) {
//       console.log(result);
//     }
//   });
// }


// /*Sort ranking list DESC*/
// function sortDESC() {
//     // console.log("http://localhost/sudoku/back-end/users?user_name="+user_name+"&name="+name+"&lastname="+lastname);
//     $.ajax({
//       url: "http://localhost/sudoku/back-end/results",
//       type: 'GET',
//       success: function (result) {
//         result.forEach((element, i) => {
//      //sve moje lijeve iz phpa
//             $( ".rank ul" ).append( "<li class='row'><em>" + (i+1) + "</em><em>"+ element.user_name +"</em><em>"+ element.name +"</em><em>"+ element.lastname +"</em><em>"+ element.score +"</em><em class='icons'>"+<i class="fas fa-sort-down" onclick="sortDESC(0)"></i>+"</em></li>" );
         
//         });
//       },
//       error: function (result) {
//         console.log(result);
//       }
//     });
//   }