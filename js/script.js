function logout() {
    console.log("izlogovan");
    $.get("logout.php", function () {
        window.location = "login.php";
      });
}

/*All users edit and delete icons*/
var icons = false;
$( ".row" ).hover(

function(){
  if (icons == false) {
    $(this).children('.icons').css('visibility', 'visible');
  } else {
    $('.icons').css('visibility', 'hidden');
  }
  icons=!icons;
}
);

/*Delete user*/
function deleteUser(username) {
  console.log("sasasjadjasd");
  // $.delete("http://localhost/sudoku/back-end/user/".$username, function (data) {

  // });
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
